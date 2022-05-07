<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\HotDeal;
use App\SubCategory;
use App\BusinessJob;
use App\BusinessInfo;
use App\BusinessJobCategory;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;



class BusinessJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $businessjob = BusinessInfo::all();
        return view('admin.business.index', compact('businessjob'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = BusinessJobCategory::orderBy('cat_name', 'asc')->get();
        $manager = "wwwww";
        return view('admin.business.create', compact('manager', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([
            'bus_job_cat_id' => 'bail|required|max:255',
            'businee_or_job' => 'bail|required|max:255',
            'title' => 'bail|required',
            'short_description' => 'bail|required',
            'long_decription' => 'bail|required',
            'business_job_name' => 'bail|required',

        ]);

          $reqData = $request->all();




        $reqData['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        BusinessJob::create($reqData);
        return redirect()->route('business.index')->withStatus(__('Business Job  is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = BusinessInfo::where('id',$id)->first();
        return view('admin.business.show')->with('business',$business);
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

                //Check if any routing has been done
               //do logic here
               $bus = BusinessInfo::where('id',$id)->first();

                if (!empty($bus)) {
                    DB::beginTransaction();
                    BusinessInfo::where('id',$id)
                            ->delete();
                    DB::commit();

                    $output = ['success' => true,
                            'msg' => "Business deleted Successfully"
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


    public function acceptrejectbusiness(Request $request){

        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                'response' => 'required',
                'status' => 'required',
                'businessid' => 'required',
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
                //$model = MemberRequest::create($input);
                $reqdatas = BusinessInfo::find($request->businessid);
                $reqdatas->response_date = Carbon::today()->format('Y-m-d');
                $reqdatas->response_info = $request->response;
                $reqdatas->status = $request->status;
                $reqdatas->responded_by = auth()->user()->id;
                $reqdatas->save();

                DB::commit();
                $output = ['success' => true,
                        'msg' => "Business Accepted Successfully"
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
}
