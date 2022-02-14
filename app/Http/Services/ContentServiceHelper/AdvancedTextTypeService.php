<?php

namespace App\Http\Services\ContentServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class AdvancedTextTypeService implements ContentType
{
    /**
     * handle function that change youtube link embed if not
     * @param string $request
     * @return string
     */
    public function handle($value)
    {
        return $value;
    }

}
