<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypalController extends Controller
{

    public function updatePaypal(Request $request)
    {
        $data = [
            'P_PRODUCTION_CLIENT_ID' => $request->P_PRODUCTION_CLIENT_ID,
            'P_SANDBOX_CLIENT_ID' => $request->P_SANDBOX_CLIENT_ID,
        ];

        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $paypal_status = 0;
        if ($request->paypal_status == '1') {
            $paypal_status = 1;
        } else {

            $paypal_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->paypal_status = $paypal_status;
        $pp->update();

        return redirect('setting')->withStatus(__('PayPal Configuration updated successfully.'));
    }
}
