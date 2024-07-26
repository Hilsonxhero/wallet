<?php

namespace Modules\Gateway\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Gateway\App\resources\GatewayResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Gateway\Enums\GatewayStatus;
use Modules\Payment\Enums\PaymentStatus;
use Modules\Payment\Enums\TransactionType;

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

        $user = $payment->invoice->user;

        if ($request->status == "success") {
            paymentRepo()->update($payment->id, [
                "status" => PaymentStatus::SUCCESS->value
            ]);

            $wallet_exists = $user->wallets()->where('wallet_id', $payment->invoice->invoiceable_id)->first();

            $prev_balance = 0;

            if (is_null($wallet_exists)) {
                $user->wallets()->create([
                    'wallet_id' => $payment->invoice->invoiceable_id,
                    'balance' => $payment->amount
                ]);
            } else {
                $prev_balance = $wallet_exists->balance;
                $wallet_exists->increment('balance', $payment->amount);
            }

            transactionRepo()->create([
                "user_id" => $user->id,
                "transactionable_type" => $payment->invoice->invoiceable_type,
                "transactionable_id" => $payment->invoice->invoiceable_id,
                "amount" => $payment->amount,
                "from" => $prev_balance,
                "to" => $prev_balance + $payment->amount,
                "type" => TransactionType::INCREMENT->value,
            ]);
        } else {
            paymentRepo()->update($payment->id, [
                "status" => PaymentStatus::FAILED->value
            ]);
        }

        return redirect()->to(front_path(env('FRONT_CHECKOUT_CALLBACK') . $payment->reference_code));
    }
}
