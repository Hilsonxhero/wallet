<?php

namespace Modules\Wallet\App\resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Payment\App\resources\TransactionResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $user = auth()->user();
        $exists_wallet = $user->wallets()->where('wallet_id', $this->id)->first();
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'transactions' => TransactionResource::collection($this->transactions()->where('user_id', auth()->id())->get()),
            'balance' => !is_null($exists_wallet) ? round($exists_wallet->balance) : 0
        );
    }
}
