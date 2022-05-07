<?php

namespace App\Http\Controllers;

use App\Application;
use App\Members;
use App\MyFamily;
use App\Payment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Members::orderby('user_id','DESC')->take(20)->get();
        $data = array(
            'applications'=>$applications,
        );
        return view('admin.application.index')->with($data);
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
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $details = Members::where('user_id',$id)->first();
       $proposer = Members::where('user_id',$details->proposedby)->first();
       $seconder = Members::where('user_id',$details->secondedby)->first();
        $payments = Payment::where([['user_id',$id],['payment_for','Registration']])->first();
        $data = array(
            'details'=>$details,
            'payments'=>$payments,
            'proposer'=>$proposer,
            'seconder'=>$seconder,
        );
        return view('admin.application.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //return $id;
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $appln = true;//Members::where('user_id', $id)->first();

                if ($can_be_deleted) {
                    if ($appln) {
                        DB::beginTransaction();
                        //Delete Query  details
                        Members::where('user_id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Application Deleted Successfully"
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

    public function acceptapplication($id)
    { //return $id;
        if (request()->ajax()) {

            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $appln = true; //Members::where('user_id', $id)->first();

                if ($can_be_deleted) {
                    if ($appln) {
                        DB::beginTransaction();
                        Members::where('user_id', $id)
                            ->update([
                                'application_status' => 'Accepted'
                                ]);

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Application Deleted Successfully"
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

    public function rejectapplication($id)
    { //return $id;
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $appln = true;//Members::where('user_id', $id)->first();

                if ($can_be_deleted) {
                    if (!empty($appln)) {
                        DB::beginTransaction();

                        Members::where('user_id', $id)
                            ->update([
                                'application_status' => 'Rejected'
                                ]);

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Application Deleted Successfully"
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

                $output = ['success' => $e->getMessage(),
                                'msg' => "Something Went Wrong"
                            ];
            }
            return $output;
        }
    }

    public function addmember(Request $request){
        $memberref = rand(100000000,999999999);

        $member = Members::create([
            'unique_id'=> $memberref,
            'firstname'=> $request->name,
            'midname'=> $request->fathername,
            'surname'=> $request->surname,
            'native'=> $request->native['native_id'],

            'birthday'=> carbon::today()->format('Y-m-d'),//createFromFormat('Y-m-d\TH:i:s.Z\Z', $request->dob)->format('Y-m-d'),
            'nationality'=> $request->nationality['country_id'],
            'town'=> $request->town['town_id'],
            'bloodgroup'=> $request->bloodgroup,
            'gender'=> $request->gender,
            'marital'=>'married',
            'boxno'=> $request->pobox,
            'country'=> $request->country['country_id'],
            'mobile'=> $request->mobileno,
            'business'=> $request->occupation,
            'email'=> $request->email,
            'physical_address'=> $request->phyaddress,
            'pwork_address'=> $request->workaddress,

            'member_type'=>$request->membertype,
            'payment_id'=>$payment->id,

            'proposedby'=>$request->proposedby['user_id'],
            'secondedby'=>$request->secondedby['user_id'],
        ]);

        $payment = Payment::create([
            'unique_id'=> rand(100000000,999999999),
            'user_id'=> $member->id,
            'amount_paid'=>$request->amount,
            'payment_for'=>'Registration',
            'payment_method'=>$request->paymentmode,
            'payment_ref'=>$request->paymentref,
        ]);

        $relative = MyFamily::create([
            'unique_member_id'=>$memberref,
            'mname'=> $request->spousename,
            'relation'=> $request->relationship,
            'native_place'=> $request->spousenative['native_id'],
            'dob'=> carbon::today()->format('Y-m-d'),//createFromFormat('M d Y', $request->spousedob)->format('Y-m-d'),
            'bgroup'=> $request->spousebloodgroup,
            'user_id'=> $member->id,
        ]);
        //$member = $member;
        return response()->json(['member' => $payment], 200);
    }

}
