<?php

namespace Modules\Gateway\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Gateway\App\resources\GatewayResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Gateway\Enums\GatewayStatus;
use Modules\Payment\Enums\PaymentStatus;

class GatewayController extends ApiController
{
    public function show($id)
    {
        $item = gatewayRepo()->find($id, "ref_code");
        $item = new GatewayResource($item);
        return  $this->successResponse($item);
    }
    public function status(Request $request, $id)
    {
        $status = GatewayStatus::FAILED->value;

        if ($request->success) {
            $status = GatewayStatus::SUCCESS->value;
        }

        $item = gatewayRepo()->find($id, "ref_code");

        gatewayRepo()->update($item->id, [
            "status" => $status
        ]);
        $callback = front_path($item->callback, ['status' => $status, 'ref_code' => $item->ref_code], true);

        return $this->successResponse($callback);
    }


    public function callback(Request $request, $type)
    {
        $payment = paymentRepo()->find($request->ref_code, "bank_ref_id");

        if ($request->status == "success") {
            paymentRepo()->update($payment->id, [
                "status" => PaymentStatus::SUCCESS->value
            ]);
        } else {
            paymentRepo()->update($payment->id, [
                "status" => PaymentStatus::FAILED->value
            ]);
        }

        return redirect()->to(front_path(env('FRONT_CHECKOUT_CALLBACK') . $payment->reference_code));
    }
}
