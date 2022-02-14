<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasRoles extends Model
{
    protected $fillable = ['role_id','user_id'];
    protected $table = "user_has_roles" ;

    public function users()
    {
        return $this->belongsTo('App\Models\User') ;
    }
}
