<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\AppUsers;
use App\Branch;
use App\Http\Requests\PasswordRequest;
use App\Notifications;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AppUsersController extends Controller
{

    public function index()
    {

        abort_if(Gate::denies('appuser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appuser = AppUsers::all();
        return view('admin.appuser.index', compact('appuser'));
    }
    public function changeStatus($id)
    {
        abort_if(Gate::denies('appuser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = AppUsers::findOrFail($id);
        $data->status = $data->status === 1 ? 0 : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
    }
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'bail|required',
            'password' => 'bail|required|min:6',
        ]);
        $user = AppUsers::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user['verified'] != 1) {
                return response()->json(['msg' => 'Please Verify your account', 'data' => null, 'success' => false, 'verification' => true], 200);
            }
            if ($user['status'] == 0) {
                return response()->json(['msg' => 'You are block by admin', 'data' => null, 'success' => false], 200);
            }
            $token = $user->createToken('user')->accessToken;
            $user['device_token'] = $request->device_token;
            $user->save();
            $user['token'] = $token;
            return response()->json(['msg' => 'Welcome back to PatelBrotherhood Nairobi ', 'data' => $user, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'Email and Password not match with our record', 'data' => null, 'success' => false], 200);
        }
        //return response()->json(['msg' => 'Email and Password not match with our record', 'data' => null, 'success' => false], 200);
    }
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'bail|required|email|unique:app_users,email',
            'name' => 'bail|required',
            'password' => 'bail|required|min:6',
            'phone_no' => 'bail|required|unique:app_users,phone_no',
        ]);
        $reqData = $request->all();

        $app = AdminSetting::get(['id', 'verification', 'sms_gateway'])->first();
        $flow = $app->verification == 1 ? 'verification' : 'home';
        if ($app->verification != 1) {
            $reqData['verified'] = 1;
        } else {
            try {
                $res = (new Admin\TwilioController)->sendOTPUser($request, $app->sms_gateway, 'verification', 0);
                if ($res['success'] === true) {
                    $reqData['otp'] = $res['otp'];

                }
            } catch (\Exception $e) {
                $reqData['verified'] = 1;
                $reqData['otp'] = '0000';

            }
        }

        $data = AppUsers::create($reqData);
        if ($app->verification != 1) {
            $token = $data->createToken('user')->accessToken;
            $data['token'] = $token;
        }
        return response()->json(['msg' => 'Welcome to to home of beauty', 'data' => $data, 'success' => true, 'flow' => $flow], 200);
    }
    public function newPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        auth()->user()->update($request->all());

        $data['token'] = auth()->user()->createToken('users')->accessToken;
        return response()->json(['msg' => 'Welcome back...', 'data' => $data, 'success' => true], 200);
    }
    public function profileUpdate(Request $request)
    {
        auth()->user()->update($request->all());
        return response()->json(['msg' => 'Profile Updated', 'data' => null, 'success' => true], 200);
    }
    public function profilePictureUpdate(Request $request)
    {
        $name = (new AppHelper)->saveBase64($request->image);

        auth()->user()->update([
            'image' => $name,
        ]);
        return response()->json(['msg' => 'Profile Updated', 'data' => null, 'success' => true], 200);
    }
    public function verifyMe(Request $request)
    {
        $request->validate([
            'phone_no' => 'bail|required',
        ]);
        if ($request->type == '1') {
        } else {

            $userData = AppUsers::Where([['phone_no', $request->phone_no]])->first();
        }

        if ($userData && $userData['verified'] === 1) {
            return response()->json(['msg' => 'You already verify ', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        } else if ($userData && $userData['verified'] != 1) {

            if ($userData['OTP'] === $request->OTP) {
                $userData->OTP = '';
                $userData->verified = 1;
                $userData->save();
                $token = $userData->createToken('user')->accessToken;
                $userData['token'] = $token;
                return response()->json(['msg' => 'Thanks For being With us', 'data' => $userData, 'success' => true], 200);
            }

            return response()->json(['msg' => 'OTP is Invalid', 'data' => $userData, 'success' => false], 200);
        } else {
            return response()->json(['msg' => 'Email and number are attached with different account', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        }
    }
    public function userFevSalon($id)
    {

        $fev = implode(",", Auth::user()->liked_salon);
        $temp = "";
        $oldfev = Auth::user()->liked_salon;
        if (in_array($id, $oldfev)) {
            $temp = str_replace($id, "", $fev);
            $temp = ltrim($temp, ',');
            $temp = rtrim($temp, ',');
            $temp = str_replace(",,", ",", $temp);
        } else {
            $temp = $fev . ',' . $id;
            $temp = ltrim($temp, ',');
            $temp = rtrim($temp, ',');
            $temp = str_replace(",,", ",", $temp);
        }

        auth()->user()->update([
            'liked_salon' => $temp,
        ]);
        return response()->json(['msg' => 'done', 'data' => null, 'success' => true], 200);
    }
    public function userFevSalonList()
    {

        $pro = Auth::user()->liked_salon;
        $data = Branch::where('status', 1)->whereIn('id', $pro)->get(['name', 'id', 'icon', 'address', 'for_who'])->each->setAppends(['avg_rating', 'imageUri']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function notiList()
    {
        $data = Notifications::where('user_id', Auth::user()->id)->get()->each->setAppends(['provider']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function privacy()
    {
        $d = AdminSetting::first();
        return response()->json(['msg' => null, 'data' => $d->pp, 'success' => true], 200);
    }
    public function password(PasswordRequest $request)
    {

        auth()->user()->update(['password' => $request->get('password')]);
        $data['token'] = auth()->user()->createToken('user')->accessToken;
        return response()->json(['msg' => "Password Change", 'data' => $data['token'], 'success' => true], 200);
    }
    public function forgot(Request $request)
    {
        $request->validate([
            'phone_no' => 'bail|required',
            'type' => 'bail|required',
        ]);
        $app = AdminSetting::get(['id', 'verification', 'sms_gateway'])->first();
        if ($request->type == '1') {
        } else {
            $userData = AppUsers::where([['phone_no', $request->phone_no]])->first();
        }
        if ($userData) {

            $res = (new Admin\TwilioController)->sendOTPUser($request, $app->sms_gateway, 'forgot', $request->type);
            if ($res['success'] === true) {
                $reqData['OTP'] = $res['otp'];
                $userData->update($reqData);
                return response()->json(['msg' => 'OTP send to your phone.', 'data' => null, 'success' => true], 200);
            } else {
                return response()->json(['msg' => 'Something went wrong.', 'data' => null, 'success' => false], 200);
            }
        }
        return response()->json(['msg' => 'You are not verified user.', 'data' => null, 'success' => false], 200);
    }
    public function forgotValidate(Request $request)
    {
        $request->validate([
            'phone_no' => 'bail|required',
            'type' => 'bail|required',
            'otp' => 'bail|required',
        ]);
        if ($request->type == '1') {
        } else {
            $userData = AppUsers::where([['phone_no', $request->phone_no], ['OTP', $request->otp]])->first();
        }
        if ($userData) {
            $userData->update(['otp' => '']);
            $data['token'] = $userData->createToken('Workeasy')->accessToken;
            return response()->json(['msg' => 'OTP is verified.', 'data' => $data, 'success' => true], 200);
        }
        return response()->json(['msg' => 'Given OTP is invalid.', 'data' => null, 'success' => false], 200);
    }
}
