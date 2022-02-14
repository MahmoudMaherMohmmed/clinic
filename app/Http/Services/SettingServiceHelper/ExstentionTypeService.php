<?php

namespace App\Http\Services\SettingServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class ExstentionTypeService implements SettingType
{
    /**
     * handle function that make update for role
     * @param UploadedFile|string $request
     * @return string
     */
    public function handle($value)
    {
        $newValue = implode(",",$value) ;

        foreach($value as $extension)
        {
            if($extension=="all")
            {
                $newValue = "all" ;
                break ;
            }
        }

        return $newValue;
    }

}
