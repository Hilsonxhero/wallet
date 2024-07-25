<?php

namespace Modules\Payment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionTransfers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "sender_transaction_id",
        "recevier_transaction_id",
    ];

    public function sender()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function recevier()
    {
        return $this->belongsTo(Transaction::class);
    }
}
