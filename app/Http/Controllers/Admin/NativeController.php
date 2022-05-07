<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Native;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Native::all();
        return view('admin.native.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.native.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //return 111;
        if (request()->ajax()) {
            try {
            $validator = Validator::make($request->all(), [
            'villagename' => 'required',
            'description' => 'required',
        ]);

            if ($validator->fails()) {
                    $output = [
                        'success' => false,
                        'msg' => "It appears you have forgotten to complete something",
                                ];
                }

            $village = $request->villagename;
            $check = Native::where('native_name',$village)->first();
            if(!empty($check)){
                $output = [
                    'success' => false,
                    'msg' => "The village/native name already exists.",
                            ];
            }

        if ($validator->passes()) {
            DB::beginTransaction();

                $nat = new Native;
                $nat->create_date = carbon::today()->format('Y-m-d');
                $nat->native_name = $request->villagename;
                $nat->additional_info = $request->description;
                $nat->createdby = Auth()->User()->id;

                $nat->save();

            DB::commit();

            $output = ['success' => true,
                        'msg' => "Native Added Successfully"
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
        $native = Native::where('native_id',$id)->first();
        return view('admin.native.edit')->with('native',$native);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { //return 111;
        if (request()->ajax()) {
            try {
            $validator = Validator::make($request->all(), [
            'villagename' => 'required',
            'description' => 'required',
        ]);

            if ($validator->fails()) {
                    $output = [
                        'success' => false,
                        'msg' => "It appears you have forgotten to complete something",
                                ];
                }

        $data = $request->only(['villagename','description']);

        if ($validator->passes()) {
            DB::beginTransaction();

                $result = Native::find($id);
                $result->update($data);
                $result->touch();

            DB::commit();

            $output = ['success' => true,
                        'msg' => "Native Updated Successfully"
                        ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                            'msg' => 'Something went wrong.',
                            ];
            }
            return $output;
        }
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

                //Check if any routing has been done
               //do logic here
               $nat = Native::where('native_id',$id)->first();

                if (!empty($nat)) {
                    DB::beginTransaction();
                        Native::where('native_id',$id)
                            ->delete();
                    DB::commit();

                    $output = ['success' => true,
                            'msg' => "Native deleted Successfully"
                        ];
                }else{
                    $output = ['success' => false,
                            'msg' => "Could not be delete, Child record exist."
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
}
