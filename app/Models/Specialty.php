<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable; 

class Specialty extends Model
{
    use Translatable, HasFactory;

    protected $table = 'specialties';
    protected $fillable = ['title', 'image', 'description'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
