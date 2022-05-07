<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\AppHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        $reqData = $request->all();
        /*if ($request->profile_image && $request->profile_image != "undefined") {
            //$reqData['profile_image'] = (new AppHelper)->savePofileImage($request);
            $image = $request->file('profile_image');
            dd($image);
            $input['imagename'] = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/images');
            $image->move($destinationPath, $input['imagename']);
            $reqData['profile_image'] = $input['imagename'];
        }*/

        auth()->user()->update($reqData);

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
