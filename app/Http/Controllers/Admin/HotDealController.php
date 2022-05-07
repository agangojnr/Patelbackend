<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\AppUsers;
use App\BookingChild;
use App\BookingMaster;
use App\HotDeal;
use App\Category;
use App\EmployeeInfo;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Review;
use App\SubCategory;
use App\User;
use App\Announcement;
use App\Information;
use App\UserNotification;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class HotDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth()->user()->id;
        //return Information::whereDoesntHave('userinformation')->orderby('id','DESC')->get();
        //return Information::whereHas('userinformation')->orderby('id','DESC')->get();

         $hotdeal = HotDeal::orderby('id','DESC')->get();
        return view('admin.hotdeal.index', compact('hotdeal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'appusers'=>AppUsers::where('status',1)->get(),
            'categories' => "wwwww",
            'manager' => "wwwww",
        );

        return view('admin.hotdeal.create')->with($data);
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
                'name' => 'bail|required|max:255',
                'sponsor_name' => 'bail|required|max:255',
                'icon' => 'bail|required|image',
                'email' => 'bail|required',
                'primary_contact' => 'bail|required',
                'amount_paid' => 'required',
                'custodian' => 'required',
                'start_date' => 'required',
                'duration' => 'required',

        ]);

       if ($validator->fails()) {
            $output = [
                'success' => false,
                'msg' => "It appears you have forgotten to complete something",
                        ];
        }

        if ($validator->passes()) {
           DB::beginTransaction();

            $startdate = Carbon::createFromFormat('m/d/Y',$request->start_date)->format('Y-m-d');
            $enddate = Carbon::parse($startdate)->addDays($request->duration)->format('Y-m-d');
            if ($request->icon && $request->icon != "undefined") {
                $icon = (new AppHelper)->saveImage($request);
            }


            $addatas = HotDeal::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'client'=>$request->sponsor_name,
                'amount_paid'=>$request->amount_paid,
                'email'=>$request->email,
                'primary_contact'=>$request->primary_contact,
                'website'=>$request->website,
                'client_phone'=>$request->primary_contact,
                'address'=>$request->address,
                'duration'=>$request->duration,
                'custodian'=>$request->custodian,

                'icon'=>$icon,
                'user_id' => Auth()->user()->id,
                'start_date' => $startdate,
                'end_date' => $enddate,
                'is_featured' => $request->has('is_featured') ? 'yes' : 'no',
                'status' => $request->has('status') ? 'Active' : 'Inactive',

                //'created_at'=>Carbon::today()->format('Y-m-d H:i:s'),

            ]);
            DB::commit();


            $output = ['success' => true,
                        'msg' => "Advert created Successfully"
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;//HotDeal::where('id',$id)->first();
        $data = array(
            'hotdeal' => HotDeal::where('id',$id)->first(),
        );
        return view('admin.hotdeal.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {

        abort_if(Gate::denies('branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = User::has('employee')->pluck('id');
        $manager = User::whereNotIn('id', $id)->orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $employee = User::whereIn('id', $id)->orderBy('name', 'asc')->get();

        return view('admin.branch.edit', compact('branch', 'manager', 'categories', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
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
                        HotDeal::where('id', $id)
                            ->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Advert Deleted Successfully"
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


    public function updateadvert(Request $request){
        if (request()->ajax()) {
            try {
            DB::beginTransaction();
                $addatas = HotDeal::find($request->advertid);
                $addatas->is_featured = $request->has('is_featured') ? 'yes' : 'no';
                $addatas->status = $request->has('status') ? 'Active' : 'Inactive';
                (!empty($request->adtitle)) ? $addatas->adtitle = $request->adtitle : '';
                (!empty($request->promotext)) ? $addatas->promotext = $request->promotext : '';
                (!empty($request->adinfo)) ? $addatas->adinfo = $request->adinfo : '';

                $addatas->save();
            DB::commit();

            $output = ['success' => true,
                        'msg' => "Changes updated Successfully"
                        ];

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

    public function apiHome()
    {
        $master = array();
        $userid = 1;//Auth()->user()->id;
        $allnotifs = Information::count();
        $readinfos = UserNotification::where('user_id',$userid)->count();
        $master['unread'] = $allnotifs - $readinfos;
        $master['featured'] = HotDeal::where([['status', 'Active'], ['is_featured', 'yes']])->get(['id', 'name', 'icon','adtitle','promotext','adinfo','primary_contact','email']);
        $master['marqueetext'] = Announcement::where('status','Active')->value('announcementtext');
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }

}
