<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\AppUsers;
use App\BookingChild;
use App\BookingMaster;
use App\Branch;
use App\Category;
use App\EmployeeInfo;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Review;
use App\SubCategory;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LicenseBoxAPI;
use Symfony\Component\HttpFoundation\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Gate::denies('branch_access')) {
            $branch = branch::all();
        } elseif (!Gate::denies('branch_manager_access')) {
            $master = branch::all();
            $branch = array();
            foreach ($master as $value) {
                if (is_array($value['manager']) && in_array(Auth::id(), $value['manager'])) {
                    array_push($branch, $value);
                }
            }
        } else {

            abort_if(true, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.branch.index', compact('branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('branch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = User::has('employee')->pluck('id');
        $manager = User::whereNotIn('id', $id)->orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $employee = User::whereIn('id', $id)->orderBy('name', 'asc')->get();
        return view('admin.branch.create', compact('manager', 'categories', 'employee'));
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
            'name' => 'bail|required|max:255',
            'address' => 'bail|required|max:255',
            'icon' => 'bail|required|image',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required',

        ]);
        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        $reqData['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        branch::create($reqData);
        return redirect()->route('branch.index')->withStatus(__('branch is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    { //return "Yesss";

        $booking = BookingMaster::with('user:id,name')->where('branch_id', $branch->id)->orderBy('id', 'desc')->get();
        $review = Review::with('user:id,name')->where('branch_id', $branch->id)->orderBy('id', 'desc')->get();
        $service = Category::with('service')->whereIn('id', $branch->category)->get();
        $employee = EmployeeInfo::with('user:id,name,email')->whereIn('emp_id', $branch->employee)->get();
        return view('admin.branch.show', compact('branch', 'booking', 'review', 'service', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {

        abort_if(Gate::denies('branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = User::has('employee')->pluck('id');
        $manager = User::whereNotIn('id', $id)->orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $employee = User::whereIn('id', $id)->orderBy('name', 'asc')->get();

        return view('admin.branch.edit', compact('branch', 'manager', 'categories', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {

        $request->validate([
            'name' => 'bail|required|max:255',
            'icon' => 'bail|sometimes|required|image',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required',
        ]);

        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        $reqData['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        $branch->update($reqData);

        return redirect()->route('branch.index')->withStatus(__('branch is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {

        abort_if(Gate::denies('branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branch->delete();

        return back()->withStatus(__('branch is deleted successfully.'));
    }
    public function apiHome()
    {
        # code...
       /* $api = new LicenseBoxAPI();
        $res = $api->verify_license();
        if ($res['status'] !== true) {
            Artisan::call('down');
            abort(503);
        }*/
        $master = array();
        $master['featured'] = Branch::where([['status', 1], ['is_featured', 1]])->get(['id', 'name', 'icon', 'address']);
        $master['popular_category'] = Category::where([['status', 1], ['is_trending', 1]])->get();
        $ids = Category::where([['status', 1], ['is_trending', 1]])->pluck('id');
        $master['more_category'] = Category::whereNotIn('id', $ids)->where([['status', 1]])->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function branchByCategory($id, Request $request)
    {
        $coder = new CoderController;
        if (method_exists($coder, 'realityCheck')) {
            $coder->realityCheck();
        } else {
            Artisan::call('down');
            abort(503);
        }

        $master = array();
        $branch = Branch::where([['status', 1]])->get(['id', 'name', 'icon', 'address', 'for_who', 'category']);
        foreach ($branch as $value) {
            # code...
            $value['fev'] = 0;
            if (is_array($value->category) && in_array($id, $value->category)) {
                if ($request->user('appUser') && is_array($request->user('appUser')->liked_salon) && in_array($value->id, $request->user('appUser')->liked_salon)) {
                    $value['fev'] = 1;
                }
                array_push($master, $value);
            }
        }
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function allBranch(Request $request)
    {
        $branch = Branch::where([['status', 1]])->get(['id', 'name', 'icon', 'address', 'for_who']);
        foreach ($branch as $value) {
            # code...
            $value['fev'] = 0;
            if ($request->user('appUser') && is_array($request->user('appUser')->liked_salon) && in_array($value->id, $request->user('appUser')->liked_salon)) {
                $value['fev'] = 1;
            }
        }
        return response()->json(['msg' => null, 'data' => $branch, 'success' => true], 200);
    }

    public function singleBranch($id, Request $request)
    {
        $branch = Branch::find($id);
        $branch->load(['reviews']);
        $branch['fev'] = 0;

        if ($request->user('appUser') && is_array($request->user('appUser')->liked_salon) && in_array($id, $request->user('appUser')->liked_salon)) {
            $branch['fev'] = 1;
        }
        return response()->json(['msg' => null, 'data' => $branch, 'success' => true], 200);
    }
    public function branchService($id, Request $request)
    {
        $category = Branch::find($id)->category;

        $data = Category::with('service')->whereIn('id', $category)->where([['status', 1]])->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function getTimeSlot(Request $request)
    {

        $br = Branch::find($request->branch_id);
        $allTimes = [];
        $beginDate = Carbon::create($request->date . ' ' . $br->start_time);
        $endDate = Carbon::create($request->date . ' ' . $br->end_time);
        $min = (int) AdminSetting::first()->time_slot_length;
        $now = Carbon::now();

        if ($beginDate->greaterThanOrEqualTo($now)) {
            array_push($allTimes, $beginDate->toTimeString());
        }
        while ($endDate->greaterThanOrEqualTo($beginDate)) {

            $beginDate->addMinutes($min);
            if ($beginDate->greaterThanOrEqualTo($now)) {
                array_push($allTimes, $beginDate->toTimeString());
            }
        }
        return response()->json(['msg' => null, 'data' => $allTimes, 'success' => true], 200);
    }

    public function getEmployee(Request $request)
    {

        $service = json_decode($request->service, true);
        $start_date = Carbon::parse($request->start_time);
        $employee = Branch::find($request->branch_id)->employee;
        $employee = EmployeeInfo::whereIn('emp_id', $employee)->where('status', 1)->get();
        for ($i = 0; $i < count($service); $i++) {
            $service[$i]['employee_data'] = [];
            $service[$i]['service_data'] = SubCategory::find($service[$i]['id'], ['name', 'price', 'for_who', 'duration', 'id']);

            foreach ($employee as $emp) {

                if (is_array($emp['service']) && in_array($service[$i]['id'], $emp['service'])) {
                    $endData = $start_date->copy()->addMinutes($service[$i]['time']);
                    $booking = BookingChild::where('emp_id', $emp['emp_id']);
                    $bc = $booking->whereBetween('start_time', array($start_date, $endData))->orWhereBetween('end_time', array($start_date, $endData))->get()->count();
                    if ($bc == 0) {
                        $emp['name'] = User::find($emp['emp_id'])->name;
                        $start_date->addMinutes($service[$i]['time']);
                        array_push($service[$i]['employee_data'], $emp);
                    }
                }
            };
            # code...
        }

        return response()->json(['msg' => null, 'data' => $service, 'success' => true], 200);
    }

    public function reportIndex()
    {
        $branch = Branch::all();
        $empid = User::has('employee')->pluck('id');
        $user = AppUsers::all();
        $employee = User::whereIn('id', $empid)->orderBy('name', 'asc')->get();
        return view('admin.report.index', compact('branch', 'employee', 'user'));
    }
    public function createReport(Request $request)
    {
        $fd = $request->from . " 00:00:00";
        $td = $request->to . " 23:59:59";

        $master = DB::select("select * from `booking_master` where (`user_id` = $request->user and `status` = $request->status and `branch_id` = $request->branch) and `created_at` between '$fd' and '$td'");
        foreach ($master as $value) {
            $value->user = AppUsers::find($value->user_id)->name;
            $value->branch = Branch::find($value->branch_id)->name;
            if ($request->emp == "emp_id") {
                $value->child_booking = BookingChild::with(['service:id,name', 'employee:id,name'])->where('booking_id', $value->id)->get();
            } else {
                $value->child_booking = BookingChild::with(['service:id,name', 'employee:id,name'])->where([['booking_id', $value->id], ['emp_id', $request->emp]])->get();
            }
            # code...
        }
        $branch = Branch::all();
        $empid = User::has('employee')->pluck('id');
        $user = AppUsers::all();
        $employee = User::whereIn('id', $empid)->orderBy('name', 'asc')->get();
        return view('admin.report.index', compact('branch', 'employee', 'user', 'master'));
    }
    public function FilterBranchBranch($type, Request $request)
    {
        $branch = Branch::where([['status', 1]]);

        if ($type == 1) {
            $branch->orderBy('created_at', 'desc');

        } elseif ($type == 2) {

            $branch->where('is_featured', 1);
        } elseif ($type == 3) {

        } elseif ($type == 4) {

            $branch->orderBy('name', 'asc');
        }
        $branch = $branch->get(['id', 'name', 'icon', 'address', 'for_who']);
        if ($type == 3) {
            $branch = $branch->toArray();
            usort($branch, function ($item1, $item2) {
                return $item1['avg_rating'] <=> $item2['avg_rating'];
            });
            $branch = array_reverse($branch);
        }
        foreach ($branch as $value) {
            # code...
            $value['fev'] = 0;
            if ($request->user('appUser') && is_array($request->user('appUser')->liked_salon) && in_array($value['id'], $request->user('appUser')->liked_salon)) {
                $value['fev'] = 1;
            }

        }
        return response()->json(['msg' => null, 'data' => $branch, 'success' => true], 200);
    }
}
