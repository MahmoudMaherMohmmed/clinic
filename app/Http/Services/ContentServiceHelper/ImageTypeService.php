<?php

namespace App\Http\Services\ContentServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class ImageTypeService implements ContentType
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'content/image';

    /**
     * handle function that make update for role
     * @param UploadedFile|string $request
     * @return string
     */
    public function handle($value)
    {
        return (new uploaderService)->upload($value, self::IMAGE_PATH);
    }

}
