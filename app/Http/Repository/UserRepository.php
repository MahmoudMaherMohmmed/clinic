<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    private $user;

    /**
     * __construct
     *
     * @param  User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        return call_user_func_array([$this->user, $method], $args);
    }
}
