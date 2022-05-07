<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RazorController extends Controller
{

    public function updatePaypal(Request $request)
    {
        $data = [
            'RAZOR_ID' => $request->RAZOR_ID,
        ];

        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $razor_status = 0;
        if ($request->razor_status == '1') {
            $razor_status = 1;
        } else {

            $razor_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->razor_status = $razor_status;
        $pp->update();

        return redirect('setting')->withStatus(__('Razorpay Configuration updated successfully.'));
    }
}
