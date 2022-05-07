<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Town;
use App\Center;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Town::all();
        return view('admin.town.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'centres'=>Center::all(),
        );
        return view('admin.town.create')->with($data);
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
            'townname' => 'required',
            'centreid' => 'required',
            'description' => 'required',
            'towncode' => 'required',
        ]);

            if ($validator->fails()) {
                    $output = [
                        'success' => false,
                        'msg' => "It appears you have forgotten to complete something",
                                ];
                }

            $town = $request->townname;
            $check = Town::where('town_name',$town)->first();
            if(!empty($check)){
                $output = [
                    'success' => false,
                    'msg' => "The Town name already exists.",
                            ];
                return $output;
            }

        if ($validator->passes()) {
            DB::beginTransaction();

                $tow = new Town;
                $tow->create_date = carbon::today()->format('Y-m-d');
                $tow->town_name = $request->townname;
                $tow->center_id = $request->centreid;
                $tow->town_code = $request->towncode;
                $tow->aditional_info = $request->description;
                $tow->user_id = Auth()->User()->id;

                $tow->save();

            DB::commit();

            $output = ['success' => true,
                        'msg' => "Town Added Successfully"
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
                        Town::where('town_id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Town Deleted Successfully"
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
