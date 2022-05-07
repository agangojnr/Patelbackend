<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'user'], function () {

    Route::group(['middleware' => ['auth:appUser']], function () {
        Route::post('booking', 'BookingMasterController@store');
        Route::post('payment', 'BookingMasterController@update');

         Route::get('myFamilyData', 'MyFamilyController@myFamilyInfo');
          Route::get('relativeData', 'MyFamilyController@relativeInfo');
         Route::get('nativeData', 'MyFamilyController@nativeInfo');
         Route::get('sportData', 'MyFamilyController@sportInfo');
         Route::get('relativeDetailData/{id}', 'MyFamilyController@relativeDetailInfo');
         Route::get('membersData', 'MyFamilyController@membersInfo');
         Route::get('familyInfoDetailData/{id}', 'MyFamilyController@familyInfoDetailInfo');
         Route::get('otherFamilyData/{id}', 'MyFamilyController@otherFamilyInfo');

          Route::get('busjobcat', 'BusinessJobCategoryController@busjobcatinfo');
          Route::get('jobData', 'BusinessJobController@jobData');

          Route::get('FilterCategoryInfo/{type}', 'BusinessJobController@FilterCategoryData');
          Route::get('jobDetailsInfo/{type}', 'BusinessJobController@jobDetailsData');

          Route::get('businessData', 'BusinessJobController@businessInfo');
             //new controllers
          Route::get('businessSectors', 'BusinessController@businessSectors');
          Route::get('businesslist/{id}', 'BusinessController@businesslist');
          Route::get('myBusinesses', 'BusinessController@myBusinesses');
          Route::get('myAdverts', 'BusinessController@myAdverts');
          Route::get('businessSector', 'BusinessJobController@businessSector');
          Route::get('jobTitle', 'BusinessJobController@jobTitle');
          Route::get('myjobData', 'BusinessJobController@myjobData');

        //new
          Route::get('addmatimonial', 'BusinessController@addmatimonial');
          Route::get('removematimonial', 'BusinessController@removematimonial');
          Route::get('matrimonialmembers', 'BusinessController@matrimonialmembers');
          Route::get('addetails/{id}', 'BusinessController@addetails');
          Route::get('readinfo/{id}', 'BusinessController@readinfo');
          Route::get('allAdverts', 'BusinessController@allAdverts');
          Route::get('allInfos', 'BusinessController@allInfos');
          Route::get('allcommittes', 'BusinessController@allcommittes');
          Route::get('recipelist', 'RecipeController@recipelist');
          Route::get('recipedetails/{id}', 'RecipeController@recipedetails');
          Route::get('getbloodgroup', 'MyFamilyController@getbloodgroup');
          Route::get('getbloodgrouptown/{bloodgroup}', 'MyFamilyController@getbloodgrouptown');
          Route::get('getbgtownmembers/{bloodgroup}/{town}', 'MyFamilyController@getbgtownmembers');
          Route::get('memberrequest', 'MemberRequestController@memberrequest');
          Route::post('addrecipe', 'RecipeController@addrecipe');
          Route::post('addrequest', 'MemberRequestController@addrequest');
          Route::get('memberlist', 'MemberRequestController@memberlist');
          Route::post('addmember', 'ApplicationController@addmember');
          Route::get('showmarquee', 'AnnouncementController@showmarquee');
          Route::post('addbusinessprofile', 'BusinessController@addbusinessprofile');
          Route::post('addJob', 'BusinessController@addJob');
        //End mew

        Route::get('booking', 'BookingMasterController@userBooking');
        Route::get('booking/{id}', 'BookingMasterController@singleBooking');

        Route::post('saveFamilyData', 'MyFamilyController@saveFamilyInfo');

        Route::post('newpassword', 'AppUsersController@newPassword');
        Route::post('review', 'Admin\ReviewController@store');

        Route::post('profile/update', 'AppUsersController@profileUpdate');
        Route::post('profile/password/update', 'AppUsersController@password');
        Route::post('profile/picture/update', 'AppUsersController@profilePictureUpdate');
        Route::get('notification', 'AppUsersController@notiList');
        Route::get('favorite/salon/{id}', 'AppUsersController@userFevSalon');
        Route::get('favorite/salon', 'AppUsersController@userFevSalonList');



        Route::get('profile', function (Request $request) {
            return $request->user();
        });
    });

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('home', 'BranchController@apiHome');
         Route::get('deals', 'HotDealController@apiHome');
        Route::get('category/{id}/branch', 'BranchController@branchByCategory');
       // Route::get('category/{id}/branch', 'BranchController@branchByCategory');
        Route::get('branch/{id}', 'BranchController@singleBranch');
        Route::get('branch', 'BranchController@allBranch');
        Route::get('filleter/branch/{type}', 'BranchController@FilterBranchBranch');
          Route::get('filleterbycategory/branch/{category_id}/{lead_id}', 'BranchController@FilterCategory');
        Route::get('branch/{id}/branchService', 'BranchController@branchService');
        Route::post('getTimeSlot', 'BranchController@getTimeSlot');
        Route::get('offer', 'OfferController@apiIndex');
        Route::post('applyCode', 'OfferController@applyCode');
        Route::get('payment/setting', 'AdminSettingController@apiPaymentData');
        Route::post('available/employee', 'BranchController@getEmployee');
        Route::get('noti/setting', 'AdminSettingController@apiNotiKey');
    });



    Route::get('privacy', 'AppUsersController@privacy');
    Route::post('register', 'AppUsersController@store');
    Route::get('subcounty/{id}', 'AppUsersController@subcounty');
    Route::post('verifyMe', 'AppUsersController@verifyMe');
    Route::post('login', 'AppUsersController@login');
    Route::post('forgot', 'AppUsersController@forgot');
    Route::post('forgot/validate', 'AppUsersController@forgotValidate');

    //New
});
