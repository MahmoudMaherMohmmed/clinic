<?php
namespace App\Http\Repository;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeRepository
{
    private $type;

    /**
     * __construct
     *
     * @param  Type $type
     * @return void
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
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
        return call_user_func_array([$this->type, $method], $args);
    }
}
