<?php

namespace Modules\Gateway\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GatewayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return array(
            'id' => $this->id,
            'ref_code' => $this->ref_code,
            'reference_code' => $this->reference_code,
            'status' => $this->status,
            'callback' => $this->callback,
            'amount' => $this->amount,
        );
    }
}
