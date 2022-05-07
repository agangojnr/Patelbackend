<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\BookingChild;
use App\MyFamily;
use App\Relation;
use App\Native;
use App\Sport;
use App\Members;
use App\Town;
use App\Branch;
use App\Http\Controllers\Admin\CoderController;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\AppUsers;
use DB;



class MyFamilyController extends Controller
{


     public function myFamilyInfo(Request $request)
    {
        $data = MyFamily::with(['native', 'relation'])->where([['user_id', Auth::id()]])->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

      public function relativeInfo(Request $request)
    {
        $data = Relation::get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function nativeInfo(Request $request)
    {
        $data = Native::get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

     public function sportInfo(Request $request)
    {
        $data = Sport::get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function relativeDetailInfo($id,Request $request)
    {
        $data = MyFamily::with(['native', 'relation', 'sport'])->where('relative_id',$id)->first();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }


    public function saveFamilyInfo(Request $request)
    {


    	$request->validate([
            'mname' => 'bail|required',
            'native_place' => 'bail|required',
            'relation' => 'bail|required',
            'sports_registered' => 'bail|required',
            'bgroup' => 'bail|required',
            'nationality' => 'bail|required',

        ]);

      $user = AppUsers::find(Auth::id());

     $fam = self::countFamily(Auth::id())[0]->people;
     $master = Auth::user()->username;
      $mid = Auth::id();
      $base_id = substr($master, 0, -2);

        //strip the last character from the master admin ID
        $user_id = $fam + 1;

       $final_id = $base_id.''.str_pad($user_id, 2, '0', STR_PAD_LEFT);



        $reqData = $request->all();
        $reqData['user_id'] = Auth::id();
        if(!empty($request->image) ){
        	//upload image

	   $name = (new AppHelper)->saveBase64($request->image);
	    $reqData['image_url']=$request->image;
        }else{
        $reqData['image_url']="";
        }
        if(!empty($request->dob) ){
        	$reqData['dob']= Carbon::parse($request->dob);
        }else{
        	$reqData['dob']="";
        }
        $reqData['unique_member_id'] = $final_id;
        $data = MyFamily::create($reqData);

       // $data = Sport::get();
        return response()->json(['msg' => 'Your Family Member Added Successfully', 'data' => null, 'success' => true], 200);
    }



      public function countFamily($id){

       return DB::table('relatives')->select('user_id', DB::raw('count(user_id) as people'))->where('user_id', '=', $id)
             ->groupBy('user_id')
             ->get();
            //check if the current member has relatives

    }

    public function membersInfo(Request $request)
    {
        //$townid = Town::where('town_name','NAIROBI')->value('town_id');
        $data = Members::addSelect([
            'townid'=> Town::select('town_id')->where('town_name','NAIROBI')->whereColumn('town_id','members.town'),
        ])->orderBy('firstname', 'asc')->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }


  public function familyInfoDetailInfo($id,Request $request)
    {
        $data = Members::with(['rcenter', 'native', 'sport', 'county', 'town'])->where('user_id',$id)->first();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }




 public function otherFamilyInfo($id,Request $request)
    {
        $data = MyFamily::with(['native', 'relation'])->where([['user_id', $id]])->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function getbloodgroup(){
        $memberData = DB::table('members')->where('bloodgroup','!=','Null')->select('bloodgroup', DB::raw('count(*) as total'))->groupby('bloodgroup')->get();

        return response()->json(['memberData' => $memberData], 200);
    }

    public function getbloodgrouptown($bloodgroup){
        //$bgData = Members::where('bloodgroup',$bloodgroup)->groupby('town')->get(['town']);

        $bgData = Town::whereHas('member',function($query) use ($bloodgroup) {
            $query->where('bloodgroup', $bloodgroup);
        })->withcount(['member'=>function($query) use ($bloodgroup) {
            $query->where('bloodgroup', $bloodgroup);
           }])->get();

        return response()->json(['bgData' => $bgData], 200);
    }

    public function getbgtownmembers($bloodgroup,$town){
        $membersData = Members::where([['bloodgroup',$bloodgroup],['town',$town]])->get();
        return response()->json(['membersData' => $membersData], 200);
    }

}
