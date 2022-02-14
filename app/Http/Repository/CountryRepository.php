<?php
namespace App\Http\Repository;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryRepository
{
    private $country;

    /**
     * __construct
     *
     * @param  Country $country
     * @return void
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
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
        return call_user_func_array([$this->country, $method], $args);
    }
}
