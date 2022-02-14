<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Center extends Model
{
    use Translatable, HasFactory;

    protected $table = 'centers';
    protected $fillable = ['description', 'working_days', 'from', 'to', 'email', 'contact_email', 'phone_1', 'phone_2', 'facebook_link', 'whatsapp_link', 'instagram_link', 'lat', 'lng', 'logo'];
}
