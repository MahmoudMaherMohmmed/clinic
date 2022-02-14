<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BaseFilter
{
    /**
     * request
     * request that comming from search query
     * @var Request $request
     */
    private $request;

    /**
     * __construct
     *
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * apply
     * apply function that have query builder that comming from model and filter that comming from query search that in Controller ofter search
     * this function return Query Builder Depend on search Key and check tht it instance from filter interface
     * @param  Builder $builder
     * @param  Array $filters
     * @return Builder
     */
    public function apply(Builder $builder, array $filters)
    {
        foreach ($this->getFilters($filters) as $key => $filter) {
            if(!$filter instanceof Filter || !$this->request->filled($key)){
                continue;
            }
            $filter->apply($builder, $this->request->get($key));
        }
        return $builder;
    }

    /**
     * getFilters
     * return array of filter that exsist in request not all filter like you make request has function but with diffrent way
     * @param  Array $filters
     * @return Array
     */
    public function getFilters(array $filters)
    {
        return Arr::only($filters, array_keys($this->request->all()));
    }
}
