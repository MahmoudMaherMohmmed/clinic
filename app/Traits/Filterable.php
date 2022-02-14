<?php

namespace App\Traits;

use App\Http\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{    
    /**
     * scopeFilter
     * this scope function return the final builder after make all querys in filters that come from search 
     * and you can use this trait in any model that needed search
     * @param  Builder $builder
     * @param  Array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, $filters)
    {
        return (new BaseFilter(request()))->apply($builder, $filters);
    }

}