<?php
namespace App\Http\Repository;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageRepository
{
    private $language;

    /**
     * __construct
     *
     * @param  Language $language
     * @return void
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
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
        return call_user_func_array([$this->language, $method], $args);
    }
}
