<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Bank extends Model
{
    use Translatable, HasFactory;

    protected $table = 'banks';
    protected $fillable = ['name', 'account_name', 'account_number', 'IBAN', 'image'];
}
