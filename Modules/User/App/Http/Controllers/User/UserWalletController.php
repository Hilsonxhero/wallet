<?php

namespace Modules\User\App\Http\Controllers\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Gateway\Facades\Payment;
use Modules\Wallet\App\resources\User\WalletResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Payment\App\Models\Invoice;
use Modules\Payment\Enums\PaymentStatus;
use Modules\Wallet\App\Models\Wallet;

class UserWalletController extends ApiController
{
    public function index(Request $request)
    {
        $wallets = walletRepo()->getActiveWallets();

        $wallets = WalletResource::collection($wallets);

        return  $this->successResponse($wallets);
    }

    public function show($id)
    {
        $wallet = walletRepo()->find($id);
        $wallet = new WalletResource($wallet);
        return  $this->successResponse($wallet);
    }
    public function credit(Request $request, $id)
    {
        $user = auth()->user();
        $wallet = walletRepo()->find($id);
        try {
            $amount = 10000;
            $purchase_url = Payment::purchase($amount, function ($driver, $transactionId) use ($amount, $user, $wallet) {

                $invoice = Invoice::query()->create([
                    "user_id" => $user->id,
                    "invoiceable_type" => get_class($wallet),
                    "invoiceable_id" => $wallet->id,
                    "amount" => $amount,
                    "description" => "شارژ کیف پول"
                ]);

                paymentRepo()->create([
                    "invoice_id" => $invoice->id,
                    "payment_method" => "online",
                    "gateway" => $wallet->type,
                    "status" => PaymentStatus::PENDING->value,
                    "bank_ref_id" => $transactionId,
                    "reference_code" => rand(1000000, 10000000),
                    "amount" => $amount,
                ]);
            })->pay();
            return  $this->successResponse($purchase_url);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
