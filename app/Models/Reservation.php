<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = ['client_id','date', 'from', 'to', 'patient_name', 'phone_number', 'age','gender', 'description', 'payment_type', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function bankTransfer()
    {
        return $this->hasOne(BankTransfer::class);
    }
}
