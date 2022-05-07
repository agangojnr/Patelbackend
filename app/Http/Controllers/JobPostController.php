<?php

namespace App\Http\Controllers;

use App\JobPost;
use App\JobTitle;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'posts'=>JobPost::all(),
        );
        return view('admin.jobposts.index')->with($data);
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
     * @param  \App\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'job'=>JobPost::where('id',$id)->first(),
        );
        return view('admin.jobposts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPost $jobPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPost $jobPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobPost  $jobPost
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
               $req = JobPost::where('id', $id)->first();

                if ($can_be_deleted) {
                    if (!empty($req)) {
                        DB::beginTransaction();
                        //Delete Query  details
                        JobPost::where('id', $id)->delete();
                        $req->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Job Post Deleted Successfully"
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


    public function acceptrejectjobpost(Request $request){
        if (request()->ajax()) {
            try {
            $validator = Validator::make($request->all(), [
            'response' => 'required',
            'status' => 'required',
            'jobid' => 'required',

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
            $jobdatas = JobPost::find($request->jobid);
            $jobdatas->response_date = Carbon::today()->format('Y-m-d');
            $jobdatas->response_info = $request->response;
            $jobdatas->status = $request->status;
            $jobdatas->responded_by = auth()->user()->id;
            $jobdatas->save();

            $output = ['success' => true,
                        'msg' => "Job post Accepted Successfully"
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
}
