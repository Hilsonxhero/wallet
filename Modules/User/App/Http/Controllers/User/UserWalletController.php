<?php

namespace Modules\User\App\Http\Controllers\User;

use Illuminate\Http\Request;
use Modules\User\App\Models\User;
use Modules\Common\App\Http\Controllers\Api\ApiController;
use Modules\Wallet\App\resources\User\WalletResource;

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
}
