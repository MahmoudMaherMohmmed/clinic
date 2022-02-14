<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
	/**
	 * apply filter function that implement in diffrent filter key
	 * @param Builder $builder 
	 * @param sring $value 
	 * @return Builder
	 */
    public function apply(Builder $builder, $value);
}