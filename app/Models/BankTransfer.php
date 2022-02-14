<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    use HasFactory;

    protected $table = 'bank_transfers';
    protected $fillable = ['reservation_id', 'bank_name', 'bank_account_name', 'bank_account_number', 'IBAN', 'image'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
