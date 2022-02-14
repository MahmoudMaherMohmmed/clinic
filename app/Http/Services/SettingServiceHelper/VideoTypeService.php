<?php

namespace App\Http\Services\SettingServiceHelper;

use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class VideoTypeService implements SettingType
{
    /**
     * @var IMAGE_PATH
     */
	const VIDEO_PATH = 'settings_videos';
    /**
     * @var UploaderService
     */
    private $uploaderService;

    /**
     * __construct
     *
     * @param  UploaderService $uploaderService
     * @return void
     */
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService  = $uploaderService;
    }
    /**
     * handle function that make update for role
     * @param UploadedFile|string $request
     * @return string
     */
    public function handle($value)
    {
        return $this->uploaderService->upload($value, self::VIDEO_PATH);
    }

}
