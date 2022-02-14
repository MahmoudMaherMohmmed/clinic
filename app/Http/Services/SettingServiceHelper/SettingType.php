<?php

namespace  App\Http\Services\SettingServiceHelper;

interface SettingType
{
    /**
     * apply
     * function to handle setting type , each type have it's implement and return string that will save in databse
     * @param  UploadedFile|String $request
     * @return String
     */
    public function handle($value);
}
