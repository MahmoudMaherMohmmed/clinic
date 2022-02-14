<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Term extends Model
{
    use Translatable, HasFactory;

    protected $table = 'terms';
    protected $fillable = ['description'];
}
