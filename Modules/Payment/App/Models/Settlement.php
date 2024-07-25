<?php

namespace Modules\Payment\App\Models;

use Modules\User\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settlement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "amount",
        "from",
        "to",
        "reference_code",
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
