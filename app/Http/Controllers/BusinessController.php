<?php

namespace App\Http\Controllers;

use App\BusinessInfo;
use App\BusinessJob;
use App\BusinessSector;
use App\JobPost;
use App\HotDeal;
use App\Members;
use App\AppUsers;
use App\Town;
use App\Information;
use App\Committee;
use App\UserNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function businessSectors(Request $request)
    {
    	$master = array();

       $master['category']= BusinessSector::withCount('Businessinfo')->get();

       // $master['jobs'] = BusinessJob::where([['businee_or_job', '1']])->count();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function businesslist($id)
    {
        $master = array();
       $master['result']= BusinessInfo::where('sector_id',$id)->orderby('id','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function allAdverts()
    {
        $master = array();
       $master['result']= HotDeal::where('status','Active')->orderby('id','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function myBusinesses()
    {
    	$master = array();
        $createdby = Auth()->user()->id;
        $master['result']= BusinessInfo::where('user_id',$createdby)->orderby('id','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function myAdverts()
    {
    	$master = array();
        $createdby = Auth()->user()->id;
        $master['result']= HotDeal::where('custodian',$createdby)->orderby('id','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function addetails($id){
        $master = array();
        $master['result']= HotDeal::where('id',$id)->first();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);

    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addbusinessprofile(Request $request)
    {
        $business = BusinessInfo::create([
            'sector_id'=>$request->categoryid['id'],
            'user_id'=> Auth()->user()->id,
            'business_name'=>$request->bsname,
            'description'=>$request->bsdescription,
            'physicaladdress'=>$request->phyaddress,
            'contact'=>$request->contact,
            'business_email'=>$request->email,
        ]);
        return response()->json(['business' => $business], 200);
    }


    public function addJob(Request $request)
    {
        $job = JobPost::create([
            'company_name'=>$request->companyname,
            'title_id'=>$request->titleid['id'],
            'createdby'=> Auth()->user()->id,
            'job_requirements'=>$request->requirements,
            'job_qualifications'=>$request->qualification,
            'experience'=>$request->experience,
            'no_of_vacancies'=>$request->vacancy,
            'appln_deadline'=>Carbon::today()->format('Y-m-d'),//$request->applndeadline,
            'contact'=>$request->contact,
            'email'=>$request->email,
        ]);
        return response()->json(['job' => $job], 200);
    }

    public function allInfos(){
        $master = array();
        $master['unread']= Information::whereDoesntHave('userinformation')->orderby('id','DESC')->get();
        $master['read']= Information::whereHas('userinformation')->orderby('id','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function allcommittes(){
        $master = array();
        $master['result']= Committee::orderby('year','DESC')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function readinfo($id){
        $read = UserNotification::create([
            'info_id'=>$id,
            'user_id'=> Auth()->user()->id,
        ]);
        return response()->json(['read' => $read], 200);
    }

    public function matrimonialmembers()
    {
        $master = array();
        $memberid = AppUsers::where('id',Auth()->user()->id)->value('memberid');
        $master['matrimonial'] = Members::where('user_id',$memberid)->value('matrimonial');
        $master['matrimonialmbrs'] = Members::addSelect([
            'townid'=> Town::select('town_id')->where('town_name','NAIROBI')->whereColumn('town_id','members.town'),
        ])->where('matrimonial','yes')
        ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(birthday), current_date) AS age")
        ->orderBy('firstname', 'asc')->get();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function removematimonial(){
        $memberid = AppUsers::where('id',Auth()->user()->id)->value('memberid');
        $update = Members::where('user_id',$memberid)->update(['matrimonial'=>'no']);
        return response()->json(['read' => $update], 200);
    }
    public function addmatimonial(){
        $memberid = AppUsers::where('id',Auth()->user()->id)->value('memberid');
        $update = Members::where('user_id',$memberid)->update(['matrimonial'=>'yes']);
        return response()->json(['read' => $update], 200);
    }

}
