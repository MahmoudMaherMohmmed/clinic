<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class HomeSlider extends Model
{
    use Translatable, HasFactory;

    protected $table = 'home_sliders';
    protected $fillable = ['title', 'image'];
}
