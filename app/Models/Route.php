<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['method', 'route', 'controller_name', 'function_name', 'route_name'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_route', 'route_id', 'id');
    }

    public function roles_routes()
    {
        return $this->hasMany('App\Models\RoleRoute', 'route_id', 'id');
    }

    public function delete_all_model()
    {
        return $this->hasOne('App\Models\DeleteAll', 'route_id', 'id');
    }

}
