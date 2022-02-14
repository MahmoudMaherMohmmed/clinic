<?php

namespace App\Http\Repository;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleRepository
{
    private $role;

    /**
     * __construct
     *
     * @param  Role $role
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * __call
     *
     * @param  function $method
     * @param  mixed $arguments
     * @return Closure
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->role, $method], $args);
    }
}
