<?php
namespace App\Http\Repository;

use App\Models\RbtCode;
use Illuminate\Http\Request;

class RbtRepository
{
    private $rbt;

    /**
     * __construct
     *
     * @param  RbtCode $rbt
     * @return void
     */
    public function __construct(RbtCode $rbt)
    {
        $this->rbt = $rbt;

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
        return call_user_func_array([$this->rbt, $method], $args);
    }
}
