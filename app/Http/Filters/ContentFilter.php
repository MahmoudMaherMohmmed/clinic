<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ContentFilter implements Filter
{
   /**
     * apply
     *
     * @param  Builder $builder
     * @param  string $value
     * @return Buillder for this specific search
     */
    public function apply(Builder $builder, $value)
    {
        return $builder->where('content_id', $value);
    }
}
