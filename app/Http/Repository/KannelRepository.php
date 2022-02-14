<?php

namespace App\Http\Repository;

use App\Models\Kannel;

class KannelRepository
{
    private $kannel;

    /**
     * __construct
     *
     * @param  Kannel $Kannel
     * @return void
     */
    public function __construct(Kannel $Kannel)
    {
        $this->Kannel = $Kannel;
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
        return call_user_func_array([$this->Kannel, $method], $args);
    }
}
