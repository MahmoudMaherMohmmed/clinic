<?php

namespace App\Http\Repository;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class CategoryRepository
{
    private $category;

    /**
     * __construct
     *
     * @param  Category $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
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
        return call_user_func_array([$this->category, $method], $args);
    }
}
