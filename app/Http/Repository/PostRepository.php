<?php
namespace App\Http\Repository;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository
{
    private $post;

    /**
     * __construct
     *
     * @param  Post $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
        return call_user_func_array([$this->post, $method], $args);
    }
}
