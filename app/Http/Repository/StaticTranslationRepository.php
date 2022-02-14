<?php
namespace App\Http\Repository;

use App\Models\StaticTranslation;
use Illuminate\Http\Request;

class StaticTranslationRepository
{
    private $staticTraslation;

    /**
     * __construct
     *
     * @param  StaticTranslation $staticTraslation
     * @return void
     */
    public function __construct(StaticTranslation $staticTraslation)
    {
        $this->staticTraslation = $staticTraslation;
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
        return call_user_func_array([$this->staticTraslation, $method], $args);
    }
}
