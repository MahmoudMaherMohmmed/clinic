<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasBody extends Model
{
    protected $table = 'tans_bodies';

    public function has_translation()
    {
    	return $this->belognsTo('App\Models\HasTranslation');
    }
}
