<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['title'];

    public function operator()
    {
      return $this->hasMany('App\Models\Operator','operator_id','id');
    }
}
