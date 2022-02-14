<?php
namespace App\Http\Repository;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentRepository
{
    private $content;

    /**
     * __construct
     *
     * @param  Content $content
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
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
        return call_user_func_array([$this->content, $method], $args);
    }
}
