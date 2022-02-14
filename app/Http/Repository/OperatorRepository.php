<?php
namespace App\Http\Repository;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorRepository
{
    private $operator;

    /**
     * __construct
     *
     * @param  Operator $Operator
     * @return void
     */
    public function __construct(Operator $Operator)
    {
        $this->Operator = $Operator;
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
        return call_user_func_array([$this->Operator, $method], $args);
    }
}
