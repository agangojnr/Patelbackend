<?php

namespace App\Http\Controllers;

use App\MemberRequest;
use App\User;
use App\Members;
use App\Native;
use App\Town;
use App\Relation;
use App\Country;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MemberRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function memberrequest()
    {
        $userid = Auth()->User()->id;
        $reqData = MemberRequest::where ('user_id',$userid)->orderby('id','DESC')->get();
        return response()->json(['reqData' => $reqData], 200);
    }

    public function addrequest(Request $request){
        $reqRes = MemberRequest::create([
            'date'=> Carbon::today()->format('Y-m-d'),
            'category'=> $request->category,
            'description'=> $request->description,
            'status'=> "Pending",
            'user_id'=> auth()->user()->id,
        ]);
        return response()->json(['reqRes' => $reqRes], 200);
    }

    public function memberlist(){
        $countries = Country::All();
        $towns = Town::All();
        $native = Native::All();
        $relnship = Relation::where('relation_desc','WIFE')->orwhere('relation_desc','HUSBAND')->get();
        //$mbrlistData = Members::get(['user_id',,'midname','surname',]);
        $mbrlistData = DB::select("select user_id, CONCAT_WS(' ',unique_id,firstname, midname, surname) AS mbrname from members");

        $data = array(
            'mbrlistData'=>$mbrlistData,
            'native'=>$native,
            'towns'=>$towns,
            'relnship'=>$relnship,
            'countries'=>$countries,
        );
        return response()->json(['data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $relnship = Relation::where('relation_desc','WIFE')->orwhere('relation_desc','HUSBAND')->get();
        //return $mbrlistData = DB::select("select user_id, CONCAT_WS(' ',unique_id,firstname, midname, surname) AS mbrname from members");
        $requests = MemberRequest::All();
        $data = array(
            'requests'=>$requests,
        );
       return view('admin.requests.index')->with($data);
    }

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
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function show(MemberRequest $memberRequest, $id)
    {
        $request = MemberRequest::where('id',$id)->first();
        $data = array(
            'request'=>$request,
        );
        return view('admin.requests.show')->with($data);
    }

    public function acceptrejectrequest(Request $request){

        if (request()->ajax()) {
            try {
            $validator = Validator::make($request->all(), [
            'response' => 'required',
            'status' => 'required',
            'requestid' => 'required',

        ]);

          //$input = $request->except(['_token']);
          //$input['user_id']=1;

       if ($validator->fails()) {
            $output = [
                'success' => false,
                'msg' => "It appears you have forgotten to complete something",
                        ];
        }

        if ($validator->passes()) {
            //$model = MemberRequest::create($input);
            $reqdatas = MemberRequest::find($request->requestid);
            $reqdatas->response_date = Carbon::today()->format('Y-m-d');
            $reqdatas->response = $request->response;
            $reqdatas->status = $request->status;
            $reqdatas->responded_by = auth()->user()->id;
            $reqdatas->save();

            $output = ['success' => true,
                        'msg' => "Request Accepted Successfully"
                        ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                            'msg' => $e->getMessage(),
                            ];
            }
            return $output;
        }
    }


    public function rejectrequest(MemberRequest $memberRequest, $id){
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $req = MemberRequest::find($id);

                if ($can_be_deleted) {
                    if (!empty($req)) {
                        DB::beginTransaction();
                        $req->status = "Rejected";
                        $req->save();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Request Rejected Successfully"
                            ];
                    }else{
                        $output = ['success' => false,
                                'msg' => "Could not be deleted, Child record exist."
                            ];
                    }
                } else {
                    $output = ['success' => false,
                                'msg' => $error_msg
                            ];
                }
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                                'msg' => "Something Went Wrong"
                            ];
            }
            return $output;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberRequest $memberRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberRequest $memberRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $req = MemberRequest::where('id', $id)->first();

                if ($can_be_deleted) {
                    if (!empty($req)) {
                        DB::beginTransaction();
                        //Delete Query  details
                        MemberRequest::where('id', $id)->delete();
                        $req->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Request Deleted Successfully"
                            ];
                    }else{
                        $output = ['success' => false,
                                'msg' => "Could not be deleted, Child record exist."
                            ];
                    }
                } else {
                    $output = ['success' => false,
                                'msg' => $error_msg
                            ];
                }
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                                'msg' => "Something Went Wrong"
                            ];
            }
            return $output;
        }
    }

}
