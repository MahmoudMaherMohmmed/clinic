<?php

namespace App\Http\Services\ContentServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class YoutubeTypeService implements ContentType
{
    /**
     * handle function that change youtube link embed if not
     * @param string $request
     * @return string
     */
    public function handle($value)
    {
        $link = explode('?v=',$value);
        if(isset($link[1]))
        {
            $value = 'http://www.youtube.com/embed/'.$link[1].'?rel=0';
        }
        return $value;
    }

}
