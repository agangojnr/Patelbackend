<?php

namespace App\Http\Controllers;

use App\BusinessSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusinessSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'sectors'=>BusinessSector::All(),
        );
        return view('admin.businesssector.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.businesssector.create');
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
            'bssectorname' => 'required',
            'description' => 'required',

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
           DB::beginTransaction();
            $sectdatas = BusinessSector::create([
                'sector_name'=>$request->bssectorname,
                'sector_description'=>$request->description,
                'created_by'=>Auth()->user()->id,
            ]);
            DB::commit();


            $output = ['success' => true,
                        'msg' => "Business sector added Successfully"
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
     * @param  \App\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSector $businessSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSector $businessSector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessSector $businessSector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessSector  $businessSector
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
                        BusinessSector::where('id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Business Sector Deleted Successfully"
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
                                'msg' => $e->getMessage()
                            ];
            }
            return $output;
        }
    }
}
