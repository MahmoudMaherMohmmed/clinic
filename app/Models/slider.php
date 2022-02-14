<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Slider extends Model
{
    use Translatable, HasFactory;

    protected $table = 'sliders';
    protected $fillable = ['title', 'image', 'description'];
}
