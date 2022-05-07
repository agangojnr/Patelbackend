<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function updateStripe(Request $request)
    {
        $data = [
            'STRIPE_KEY' => $request->STRIPE_KEY,
            'STRIPE_SECRET' => $request->STRIPE_SECRET,
        ];

        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $stipe_status = 0;
        if ($request->stipe_status == '1') {
            $stipe_status = 1;
        } else {

            $stipe_status = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->stipe_status = $stipe_status;
        $pp->update();

        return redirect('setting')->withStatus(__('Stripe Configuration updated successfully.'));
    }

    public function makePayment($amt, $token, $cur)
    {
        try {
            $stripe = new Stripe(env('STRIPE_SECRET'));
            $charge1 = $stripe->charges()->create([
                'currency' => $cur,
                'amount' => (float) $amt * 100,
                'source' => $token,
            ]);
            return ['charge_id' => $charge1['id'], 'status' => true];
        } catch (\Throwable $th) {
            return ['charge_id' => '', 'status' => false];
        }
    }
}
