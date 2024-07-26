<?php

namespace Modules\Payment\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return array(
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'payment_method' => $this->payment_method,
            'gateway' => $this->gateway,
            'status' => $this->status,
            'bank_ref_id' => $this->bank_ref_id,
            'reference_code' => $this->reference_code,
            'amount' => $this->amount,
            'invoice' => $this->invoice,
            'created_at' => formatGregorian($this->created_at, '%A, %d %B'),

        );
    }
}
