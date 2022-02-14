<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Doctor extends Model
{
    use Translatable, HasFactory;

    protected $table = 'doctors';
    protected $fillable = ['name', 'image', 'subspecialty', 'medical_examination_price', 'graduation_university'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
