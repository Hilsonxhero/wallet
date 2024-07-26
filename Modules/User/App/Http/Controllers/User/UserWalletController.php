<?php

namespace Modules\User\App\Http\Controllers\User;

use Illuminate\Http\Request;
use Modules\Gateway\Facades\Payment;
use Modules\Payment\App\Models\Invoice;
use Modules\Payment\Enums\PaymentStatus;
use Modules\Payment\Enums\TransactionType;
use Modules\Wallet\App\resources\User\WalletResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;

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
            $amount = $request->input('amount');
            $purchase_url = Payment::via($wallet->type)->purchase($amount, function ($driver, $transactionId) use ($amount, $user, $wallet) {
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

    public function withdraw(Request $request, $id)
    {
        $user = auth()->user();

        $wallet = walletRepo()->find($id);

        $wallet_exists = $user->wallets()->where('wallet_id', $wallet->id)->first();

        if ($request->amount > 0 && !is_null($wallet_exists)) {

            $prev_balance = $wallet_exists->balance;

            $wallet_exists->decrement('balance', $request->amount);

            transactionRepo()->create([
                "user_id" => $user->id,
                "transactionable_type" => get_class($wallet),
                "transactionable_id" => $wallet->id,
                "amount" => $request->amount,
                "from" => $prev_balance,
                "to" => $prev_balance - $request->amount,
                "type" => TransactionType::DECREMENT->value,
            ]);

            $wallet = walletRepo()->find($id);

            return $this->successResponse(new WalletResource($wallet));
        }
    }

    public function transfer(Request $request, $id)
    {
        $user = auth()->user();

        $recevier_user = userRepo()->find($request->input("email"), "email");

        if (is_null($recevier_user) || $recevier_user->email == $user->email) {
            return $this->successResponse(false);
        }

        $wallet = walletRepo()->find($id);

        $wallet_exists = $user->wallets()->where('wallet_id', $wallet->id)->first();

        if ($request->amount > 0 && !is_null($wallet_exists)) {

            $prev_balance = $wallet_exists->balance;

            $wallet_exists->decrement('balance', $request->amount);

            transactionRepo()->create([
                "user_id" => $user->id,
                "transactionable_type" => get_class($wallet),
                "transactionable_id" => $wallet->id,
                "amount" => $request->amount,
                "from" => $prev_balance,
                "to" => $prev_balance - $request->amount,
                "type" => TransactionType::DECREMENT->value,
            ]);

            $recevier_wallet_exists = $recevier_user->wallets()->where('wallet_id', $wallet->id)->first();
            $recevier_prev_balance = 0;
            if (is_null($recevier_wallet_exists)) {
                $recevier_user->wallets()->create([
                    'wallet_id' => $wallet->id,
                    'balance' => $request->amount
                ]);
            } else {
                $recevier_prev_balance = $recevier_wallet_exists->balance;
                $recevier_wallet_exists->increment('balance', $request->amount);
            }
            transactionRepo()->create([
                "user_id" => $recevier_user->id,
                "transactionable_type" => get_class($wallet),
                "transactionable_id" => $wallet->id,
                "amount" => $request->amount,
                "from" => $recevier_prev_balance,
                "to" => $recevier_prev_balance + $request->amount,
                "type" => TransactionType::INCREMENT->value,
            ]);

            $wallet = walletRepo()->find($id);

            return $this->successResponse(new WalletResource($wallet));
        }
    }
}
