<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\BookingChild;
use App\BookingMaster;
use App\Branch;
use App\Http\Controllers\Admin\CoderController;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BookingMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      /*  $coder = new CoderController;
        if (method_exists($coder, 'realityCheck')) {
            $coder->realityCheck();
        } else {

            Artisan::call('down');
            abort(503);
        }*/

        if (!Gate::denies('booking_access')) {

            $booking = BookingMaster::with(['branch:name,id', 'user:name,id'])->orderBy('id', 'desc')->get();
        } elseif (!Gate::denies('branch_booking_access')) {
            $master = Branch::all();
            $branch = array();
            foreach ($master as $value) {
                if (is_array($value['manager']) && in_array(Auth::id(), $value['manager'])) {
                    array_push($branch, $value['id']);
                }
            }
            $booking = BookingMaster::whereIn('branch_id', $branch)->with(['branch:name,id', 'user:name,id'])->orderBy('id', 'desc')->get();
        } else {

            abort_if(true, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('admin.booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'branch_id' => 'bail|required',
            'start_time' => 'bail|required|date_format:Y-m-d H:i:s',
            'discount' => 'bail|required',
            'total' => 'bail|required',
            'duration' => 'bail|required',
        ]);
        $reqData = $request->all();
        $reqData['user_id'] = Auth::id();
        $startTime = Carbon::parse($request->start_time);
        $reqData['end_time'] = $startTime->copy()->addMinutes($request->duration);
        $reqData['booking_id'] = substr(uniqid('bhk-'), 0, 10);
        $data = BookingMaster::create($reqData);

        if ($data['payment_method'] === 'Stipe') {
            $cur = AdminSetting::first()->currency;
            try {
                $res = (new Admin\StripeController)->makePayment($reqData['total_amount'], $data['payment_token'], $cur);
                if ($res['status']) {
                    $data->update(['payment_token' => $res['charge_id']]);
                } else {
                    return response()->json(['msg' => 'Something went wrong.', 'data' => $data, 'success' => false], 200);
                }
            } catch (\Throwable $th) {
                return response()->json(['msg' => 'Something went wrong.', 'data' => $data, 'success' => false], 200);
            }
        }
        $arr = $request->service;
        foreach (json_decode($arr, true) as $value) {
            $value['booking_id'] = $data['id'];
            $value['start_time'] = $startTime->copy();
            $value['end_time'] = $startTime->addMinutes($value['duration']);
            BookingChild::create($value);
        }

        return response()->json(['msg' => 'Your Booking is arrived , wait  for confirmation', 'data' => $data['id'], 'success' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingMaster  $bookingMaster
     * @return \Illuminate\Http\Response
     */
    public function show(BookingMaster $id)
    {

        $bookingMaster = $id;
        $bookingMaster->load(['branch:name,id,icon,address', 'user:name,id,email', 'services.service', 'services.employee']);

        return view('admin.booking.show', compact('bookingMaster'));
    }

    public function statusChange(BookingMaster $id, $status)
    {

        $id->update(['status' => $status]);
        $ids = array();
        $ids['user_id'] = $id->user_id;
        $ids['bid'] = $id->id;

        if ($status == '1') {

            try {
                $res = (new Admin\StaticNotiController)->baseNotification($ids, 2);

            } catch (\Throwable $th) {
                throw $th;
            }
        } elseif ($status == '5') {

            try {
                $res = (new Admin\StaticNotiController)->baseNotification($ids, 6);

            } catch (\Throwable $th) {

            }
        } elseif ($status == '3') {

            try {
                $res = (new Admin\StaticNotiController)->baseNotification($ids, 3);

            } catch (\Throwable $th) {

            }
        }
        return back()->withStatus(__('Status is changed successfully.'));
    }
    public function collectPayment(BookingMaster $id)
    {

        $id->update(['payment_status' => 1]);
        return back()->withStatus(__('Payment collected successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingMaster  $bookingMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingMaster $bookingMaster)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingMaster  $bookingMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingMaster $bookingMaster)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingMaster  $bookingMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingMaster $bookingMaster)
    {

    }
    public function userBooking(Request $request)
    {
        $data['upcoming'] = BookingMaster::with(['review', 'branch:id,name,icon,address'])->where([['user_id', Auth::id()], ['status', '!=', 2], ['status', '!=', 3]])->get();
        $data['past'] = BookingMaster::with(['review', 'branch:id,name,icon,address'])->where([['user_id', Auth::id()], ['status', 2]])->get();
        $data['cancel'] = BookingMaster::with(['review', 'branch:id,name,icon,address'])->where([['user_id', Auth::id()], ['status', 3]])->get();

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function singleBooking($id)
    {
        $bookingMaster = BookingMaster::find($id);
        $bookingMaster->load(['branch:name,id,icon,address', 'user:name,id,email', 'services.service', 'services.employee', 'review']);

        return response()->json(['msg' => null, 'data' => $bookingMaster, 'success' => true], 200);
    }
}
