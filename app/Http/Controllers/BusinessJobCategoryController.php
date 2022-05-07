<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\BookingChild;
use App\BusinessJob;
use App\BusinessJobCategory;
use App\Http\Controllers\Admin\CoderController;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\AppUsers;
use DB;

class BusinessJobCategoryController extends Controller
{


	 public function busjobcatinfo(Request $request)
    {
        $d = BusinessJobCategory::get();
        return response()->json(['msg' => null, 'data' => $d, 'success' => true], 200);
    }




}
