<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Center;
use App\Country;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = array(
            'centres' => Center::all(),
         );
        return view('admin.centre.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'countries'=>Country::all(),
        );
        return view('admin.centre.create')->with($data);
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
            'centrename' => 'required',
            'country' => 'required',
            'description' => 'required',
            'centrecode' => 'required',
        ]);

            if ($validator->fails()) {
                    $output = [
                        'success' => false,
                        'msg' => "It appears you have forgotten to complete something",
                                ];
                }

            $centre = $request->centrename;
            $check = Center::where('center_name',$centre)->first();
            if(!empty($check)){
                $output = [
                    'success' => false,
                    'msg' => "The Centre name already exists.",
                            ];
                return $output;
            }

        if ($validator->passes()) {
            DB::beginTransaction();

                $cen = new Center;
                $cen->create_date = carbon::today()->format('Y-m-d');
                $cen->center_name = $request->centrename;
                $cen->country_id = $request->country;
                $cen->center_code = $request->centrecode;
                $cen->aditional_info = $request->description;
                $cen->user_id = Auth()->User()->id;

                $cen->save();

            DB::commit();

            $output = ['success' => true,
                        'msg' => "Native Added Successfully"
                        ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                            'msg' => 'Something went wrong!',
                            ];
            }
            return $output;
        }
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
        return view('admin.centre.edit');
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
                        Center::where('id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Centre Deleted Successfully"
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
