<?php

namespace App\Http\Controllers\Admin;

use App\BookingMaster;
use App\Branch;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Offer;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coder = new CoderController;
        if (method_exists($coder, 'realityCheck')) {

            $coder->realityCheck();
        } else {

            Artisan::call('down');
            abort(503);
        }

        abort_if(Gate::denies('offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offers = Offer::all()->append('branchData');

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('offer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $branch = Branch::orderBy('name', 'asc')->get();

        return view('admin.offers.create', compact('branch'));
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
            'discount' => 'bail|required|numeric|min:0',
            'min_amount' => 'bail|required|numeric|min:0',
            'title' => 'bail|required|unique:offers|max:255',
        ]);
        $reqData = $request->all();

        $reqData['status'] = $request->has('status') ? 1 : 0;
        Offer::create($reqData);
        return redirect()->route('offers.index')->withStatus(__('Offer is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {

        abort_if(Gate::denies('offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $branchs = Branch::orderBy('name', 'asc')->get();

        return view('admin.offers.edit', compact('offer', 'branchs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {

        $request->validate([
            'title' => 'bail|required|max:255',
            'discount' => 'bail|required|numeric|min:0',
            'min_amount' => 'bail|required|numeric|min:0',
        ]);
        $reqData = $request->all();
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }

        $reqData['status'] = $request->has('status') ? 1 : 0;
        $offer->update($reqData);

        return redirect()->route('offers.index')->withStatus(__('Offer is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {

        abort_if(Gate::denies('offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer->delete();

        return back()->withStatus(__('Offer is deleted successfully.'));
    }
    public function apiIndex()
    {
        $offer = Offer::where('status', 1)->get();
        return response()->json(['msg' => null, 'data' => $offer, 'success' => true], 200);
    }
    public function applyCode(Request $request)
    {
        $today = Carbon::today();
        $offer = Offer::find($request->id);
        if ($offer->how_expire == 1) {
            $count = BookingMaster::where('offer_id', $request->id)->count();
            if ($offer->max_usage > 0 && $count >= $offer->max_usage) {

                return response()->json(['msg' => 'Offer expire select different offer', 'data' => null, 'success' => false], 200);
            }
        } else {

            if ($today > $offer['expiry_date']) {
                return response()->json(['msg' => 'Offer expire select different offer', 'data' => null, 'success' => false], 200);
            }
        }
        if ($offer->max_use_user > 0) {
            $count = BookingMaster::where([['offer_id', $request->id], ['user_id', Auth::id()]])->count();
            if ($count >= $offer->max_use_user) {

                return response()->json(['msg' => 'You use maximum time this offer', 'data' => null, 'success' => false], 200);
            }
        }
        if ($offer->min_amount > $request->amount) {
            return response()->json(['msg' => 'Total amount is less for this offer please increases amount to apply offer', 'data' => null, 'success' => false], 200);
        }
        return response()->json(['msg' => 'Wohoo offer applied successfully', 'data' => $offer, 'success' => true], 200);
    }
}
