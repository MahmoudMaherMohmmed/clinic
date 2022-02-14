<?php
namespace App\Http\Repository;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingRepository
{
    private $setting;

    /**
     * __construct
     *
     * @param  Setting $setting
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
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
        return call_user_func_array([$this->setting, $method], $args);
    }
}
