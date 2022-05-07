<?php

namespace App\Http\Controllers;

use App\AppUsers;
use App\BookingMaster;
use App\HotDeal;
use App\BusinessJob;
use App\Members;
use App\Offer;
use App\SubCategory;
use App\Town;
use Carbon\Carbon;
use App\Native;
use App\MemberRequest;
use App\Announcement;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use LicenseBoxAPI;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $activeann = Announcement::where('status','Active')->first();
        $distribution = DB::table('members')->select('town', DB::raw('count(*) as total'))->groupby('town')->take(10)->orderby('total','DESC')->get();
        $totals=[]; $towns = []; //$townstotal = [];
        foreach($distribution as $dist){
            $twn = Town::where('town_id',$dist->town)->value('town_name');
            $towns[] = $twn;
            $totals[] = $dist->total;
            $townstotal[] = array(
                'value'=>$dist->total,
                'name'=>$twn
            );
        }


        $data = array(
            'user' => Members::where('application_status','Accepted')->count(),
            'appuser' => AppUsers::count(),
            'pending' => Members::where('application_status','Pending')->count(),
            'pendingreq' => MemberRequest::where('status','Pending')->count(),
            'natives' => DB::table('members')->select('native', DB::raw('count(*) as total'))->groupby('native')->take(6)->orderby('total','DESC')->get(),
            'activeann'=>(empty($activeann))? 'no' : 'yes',
            'nofeatured' => HotDeal::where('is_featured','yes')->count(),
            'noactive' => HotDeal::where('status','Active')->count(),
        );
        //return $townstotal;

        return view('dashboard')
            ->with('towns',json_encode($towns,JSON_NUMERIC_CHECK))
            ->with('totals',json_encode($totals,JSON_NUMERIC_CHECK))
            ->with('townstotal',json_encode($townstotal,JSON_NUMERIC_CHECK))
            ->with($data);



    }
}
