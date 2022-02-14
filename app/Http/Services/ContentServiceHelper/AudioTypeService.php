<?php

namespace App\Http\Services\ContentServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class AudioTypeService implements ContentType
{
    /**
     * @var IMAGE_PATH
     */
	const AUDIO_PATH = 'content/audio';

    /**
     * handle function that make update for role
     * @param UploadedFile|string $request
     * @return string
     */
    public function handle($value)
    {
        return (new uploaderService)->upload($value, self::AUDIO_PATH);
    }

}
