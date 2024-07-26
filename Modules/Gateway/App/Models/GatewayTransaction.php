<?php

namespace Modules\Gateway\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GatewayTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "ref_code",
        "reference_code",
        "status",
        "callback",
        "amount",
    ];
}
