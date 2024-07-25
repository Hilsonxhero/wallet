<?php

namespace Modules\User\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return array(
            'id' => $this->id,
            'email' => $this->email,
            'created_at' => formatGregorian($this->created_at, '%A, %d %B'),
        );
    }
}
