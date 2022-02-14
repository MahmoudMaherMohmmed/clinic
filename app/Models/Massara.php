<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Massara extends Model
{
    use Translatable, HasFactory;

    protected $table = 'massaras';
    protected $fillable = ['description'];
}
