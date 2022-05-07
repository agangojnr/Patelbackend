<?php

namespace App\Http\Controllers;

use App\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['announcements'] = Announcement::orderby('id','DESC')->get();

        return view('admin.announcement.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //return $request->all();
        if (request()->ajax()) {
            try {
            $validator = Validator::make($request->all(), [
            'announcementtext' => 'required',
        ]);

            if ($validator->fails()) {
                    $output = [
                        'success' => false,
                        'msg' => "It appears you have forgotten to complete something",
                                ];
                }

        if ($validator->passes()) {
            DB::beginTransaction();
            $status = ($request->status) ? 'Active' : "Inactive";

                if($request->status){
                    $check = Announcement::where('status','Active')->first();
                        if(!empty($check)){
                            Announcement::where('status','Active')
                            ->update([
                                'status' => 'Inactive'
                                ]);
                        }
                }

            $annou = new Announcement;
                $annou->date = carbon::today()->format('Y-m-d');
                $annou->createdby = Auth()->User()->id;
                $annou->announcementtext = $request->announcementtext;
                $annou->status = $status;

                $annou->save();

            DB::commit();

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            try {

                //Check if any routing has been done
               //do logic here
               $annou = Announcement::where('id',$id)->first();

                if (!empty($annou)) {
                    DB::beginTransaction();
                        Announcement::where('id',$id)
                            ->delete();
                    DB::commit();

                    $output = ['success' => true,
                            'msg' => "Announcement deleted Successfully"
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

    public function deactivate($id)
    {
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $annou = true;

                if ($can_be_deleted) {
                    if (!empty($annou)) {
                        DB::beginTransaction();

                        Announcement::where('id', $id)
                            ->update([
                                'status' => 'Inactive'
                                ]);

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Announcement deactivated Successfully"
                            ];
                    }else{
                        $output = ['success' => false,
                                'msg' => "Could not be deactivated, Child record exist."
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

    public function activate($id)
    {
        if (request()->ajax()) {
            try {

                //Check if any routing has been done
               //do logic here
               $annou = true;

                if ($annou) {
                    DB::beginTransaction();
                    $check = Announcement::where('status','Active')->first();
                    if(!empty($check)){
                        Announcement::where('status','Active')
                        ->update([
                            'status' => 'Inactive'
                            ]);
                    }
                    Announcement::where('id', $id)
                        ->update([
                            'status' => 'Active'
                            ]);

                    DB::commit();

                    $output = ['success' => true,
                            'msg' => "Announcement activated Successfully"
                        ];
                }else{
                    $output = ['success' => false,
                            'msg' => "Could not be activated, Child record exist."
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
