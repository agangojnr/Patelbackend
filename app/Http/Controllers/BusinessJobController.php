<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\BookingChild;
use App\BusinessJob;
use App\BusinessJobCategory;

//new
use App\BusinessSector;
use App\JobTitle;

use App\Http\Controllers\Admin\CoderController;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\AppUsers;
use App\JobPost;
use DB;

class BusinessJobController extends Controller
{

    public function myjobData()   {
        $master = array();
        $userid = Auth()->user()->id;
        $master['myjobs'] = JobPost::addSelect([
            'jobtitle'=>JobTitle::select('title')->whereColumn('title_id','job_titles.id')
        ])->where('createdby',$userid)->get();

        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
       public function jobData()   {
            $master = array();
            $master['noofjobs']= JobPost::where([['status','Accepted'],['show_status','Active']])->count();
            $master['jobs'] = JobPost::addSelect([
                'jobtitle'=>JobTitle::select('title')->whereColumn('title_id','job_titles.id')
            ])->where('status','Accepted')->get();

            return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
        }


     public function FilterCategoryData($type, Request $request)
    {
        $businessjob = BusinessJob::where([['businee_or_job', 1]]);

        if ($type == 1) {
            $businessjob->orderBy('created_at', 'desc');

        } elseif ($type == 2) {

            $businessjob->orderBy('title', 'asc');
        }

        $master['category'] = $businessjob->get();

       $master['jobs'] = BusinessJob::where([['businee_or_job', '1']])->count();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }


     public function jobDetailsData($id, Request $request)
    {
        $data = JobPost::addSelect([
            'jobtitle'=>JobTitle::select('title')->whereColumn('title_id','job_titles.id')
        ])->where('id',$id)->first();

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

      public function businessInfo(Request $request)
        {
            $master = array();

        $master['category']= BusinessJob::with(['busjobcategory'])->where([['businee_or_job', '2']])->get();

            $master['jobs'] = BusinessJob::where([['businee_or_job', '2']])->count();
            return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
        }



    public function businessSector(){
        $master = array();
        $master['sectorData']= BusinessSector::All();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

    public function jobTitle(){
        $master = array();
        $master['titleData']= JobTitle::All();
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }



}
