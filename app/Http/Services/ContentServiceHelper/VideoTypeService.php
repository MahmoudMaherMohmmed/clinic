<?php

namespace App\Http\Services\ContentServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class VideoTypeService implements ContentType
{
    /**
     * @var IMAGE_PATH
     */
    const VIDEO_PATH = 'content/video';

    /**
     * handle function that make update for role
     * @param UploadedFile|string $request
     * @return string
     */
    public function handle($value)
    {
        return (new uploaderService)->upload($value, self::VIDEO_PATH);
    }
}
