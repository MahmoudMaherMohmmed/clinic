<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class News extends Model
{
    use Translatable, HasFactory;

    protected $table = 'news';
    protected $fillable = ['title', 'image', 'description'];
}
