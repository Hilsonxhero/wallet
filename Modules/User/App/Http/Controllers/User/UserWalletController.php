<?php

namespace Modules\User\App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Gateway\Facades\Payment;
use Modules\Payment\App\Models\Invoice;
use Modules\Payment\Enums\PaymentStatus;
use Modules\Payment\Enums\TransactionType;
use Modules\Wallet\App\resources\User\WalletResource;
use Modules\Common\App\Http\Controllers\Api\ApiController;

class UserWalletController extends ApiController
{
    /**
     * Display a list of all wallets.
     *
     * @param Request $request The HTTP request object containing any query parameters or filters.
     * @return JsonResponse The response containing the list of all wallets.
     */
    public function index(Request $request): JsonResponse
    {
        $wallets = walletRepo()->getActiveWallets();

        $wallets = WalletResource::collection($wallets);

        return  $this->successResponse($wallets);
    }

    /**
     * Display the details of a specific wallet.
     *
     * @param int $id The ID of the wallet to be displayed.
     * @return JsonResponse The response containing the wallet details.
     */
    public function show($id): JsonResponse
    {
        $wallet = walletRepo()->find($id);
        $wallet = new WalletResource($wallet);
        return  $this->successResponse($wallet);
    }

    /**
     * Handle the request to increase the wallet balance.
     *
     * @param Request $request The HTTP request object containing the details of the increase.
     * @param int $id The ID of the  wallet where the balance is to be increased.
     * @return JsonResponse The response indicating the result of the increase operation.
     */
    public function credit(Request $request, $id): JsonResponse
    {
        $user = auth()->user();
        $wallet = walletRepo()->find($id);
        try {
            $amount = $request->input('amount');
            $purchase_url = Payment::via($wallet->type)->purchase($amount, function ($driver, $transactionId) use ($amount, $user, $wallet) {

                $invoice = invoiceRepo()->create([
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


    /**
     * Handle the request to withdraw an amount from the wallet balance.
     *
     * @param Request $request The HTTP request object containing withdrawal details.
     * @param int $id The ID of the  wallet from which the withdrawal is to be made.
     * @return JsonResponse The response indicating the result of the withdrawal operation.
     */
    public function withdraw(Request $request, $id): JsonResponse
    {
        $user = auth()->user();

        $wallet = walletRepo()->find($id);

        $wallet_exists = userRepo()->walletExistsForUser($user, $wallet);

        if ($request->amount > 0 && !is_null($wallet_exists)) {

            $prev_balance = $wallet_exists->balance;

            userRepo()->decrementWalletBalance($wallet_exists, $request->amount);

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

    /**
     * Handle the request to transfer an amount between user wallets.
     *
     * @param Request $request The HTTP request object containing transfer details.
     * @param int $id The ID of the wallet initiating the transfer.
     * @return JsonResponse The response indicating the result of the transfer operation.
     */
    public function transfer(Request $request, $id): JsonResponse
    {
        $user = auth()->user();

        $recevier_user = userRepo()->find($request->input("email"), "email");

        if (is_null($recevier_user) || $recevier_user->email == $user->email) {
            return $this->successResponse(false);
        }

        $wallet = walletRepo()->find($id);

        $wallet_exists = userRepo()->walletExistsForUser($user, $wallet);

        if ($request->amount > 0 && !is_null($wallet_exists)) {

            $prev_balance = $wallet_exists->balance;

            userRepo()->decrementWalletBalance($wallet_exists, $request->amount);

            transactionRepo()->create([
                "user_id" => $user->id,
                "transactionable_type" => get_class($wallet),
                "transactionable_id" => $wallet->id,
                "amount" => $request->amount,
                "from" => $prev_balance,
                "to" => $prev_balance - $request->amount,
                "type" => TransactionType::DECREMENT->value,
            ]);

            $recevier_wallet_exists = userRepo()->walletExistsForUser($recevier_user, $wallet);

            $recevier_prev_balance = 0;
            if (is_null($recevier_wallet_exists)) {
                $recevier_user->wallets()->create([
                    'wallet_id' => $wallet->id,
                    'balance' => $request->amount
                ]);
            } else {
                $recevier_prev_balance = $recevier_wallet_exists->balance;
                userRepo()->incrementWalletBalance($recevier_wallet_exists, $request->amount);
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
