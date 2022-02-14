<?php

namespace App\Traits;

trait LatestState
{
	public static function boot()
    {
        Parent::boot();
        Static::addGlobalScope('latest',function($query){
            return $query->latest();
        });
    }
}
