<?php

namespace App\Http\Controllers;

use App\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'comms'=>Committee::orderby('year','DESC')->limit(20)->get(),
        );
        return view('admin.committee.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.committee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {

            $validator = Validator::make($request->all(), [
                'chairperson' => 'required',
                'vicechairperson' => 'required',
                'secretary' => 'required',
                'asssecretary' => 'required',
                'treasurer' => 'required',
                'asstreasurer' => 'required',
                'year' => 'required',

        ]);

       if ($validator->fails()) {
            $output = [
                'success' => false,
                'msg' => "It appears you have forgotten to complete something",
                        ];
        }

        $checkcomm = Committee::where('year',$request->year)->first();
        if(!empty($checkcomm)){
            $output = [
                'success' => false,
                'msg' => "Committee for that year is already captured.",
                        ];
        }

        if ($validator->passes() && empty($checkcomm)) {
           DB::beginTransaction();

            $addatas = Committee::create([
                'chairperson'=>$request->chairperson,
                'vicechairperson'=>$request->vicechairperson,
                'secretary'=>$request->secretary,
                'asssecretary'=>$request->asssecretary,
                'treasurer'=>$request->treasurer,
                'asstreasurer'=>$request->asstreasurer,
                'year'=>$request->year,
                'createdby' => Auth()->user()->id,

                //'created_at'=>Carbon::today()->format('Y-m-d H:i:s'),
            ]);
            DB::commit();


            $output = ['success' => true,
                        'msg' => "Committee created Successfully"
                        ];
                }
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                            'msg' => $e->getMessage(),
                            ];
            }
            return $output;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function edit(Committee $committee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Committee  $committee
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
               $comm = true;//Members::where('user_id', $id)->first();

                if ($can_be_deleted) {
                    if ($comm) {
                        DB::beginTransaction();
                        //Delete Query  details
                        Committee::where('id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Committee Deleted Successfully"
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
