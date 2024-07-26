<?php

namespace Modules\Wallet\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\App\Models\Transaction;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "name",
        "type",
        "description",
        "slug",
        "status"
    ];


    public function transactions()
    {
        return $this->morphMany(Transaction::class, "transactionable")->orderByDesc('created_at');
    }
}
