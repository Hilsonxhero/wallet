<?php

namespace Modules\Payment\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return array(
            'id' => $this->id,
            'user_id' => $this->user_id,
            'transactionable_type' => $this->transactionable_type,
            'transactionable_id' => $this->transactionable_id,
            'transactionable' => $this->transactionable,
            'amount' => round($this->amount),
            'type' => $this->type,
            'from' => $this->from,
            'to' => $this->to,
            'created_at' => formatGregorian($this->created_at, '%A, %d %B'),
        );
    }
}
