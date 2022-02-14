<?php
namespace App\Http\Repository;

use App\Models\ContentType;
use Illuminate\Http\Request;

class ContentTypeRepository
{
    private $ContentType;

    /**
     * __construct
     *
     * @param  ContentType $ContentType
     * @return void
     */
    public function __construct(ContentType $ContentType)
    {
        $this->ContentType = $ContentType;
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
        return call_user_func_array([$this->ContentType, $method], $args);
    }
}
