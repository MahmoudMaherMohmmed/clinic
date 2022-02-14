<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteAll extends Model
{
    protected $table = "delete_all_flags";
    protected $fillable = ['route_id'] ;

    public function route_ref()
    {
        return $this->belongsTo('App\Models\RouteModel','route_id','id') ;
    }

}
