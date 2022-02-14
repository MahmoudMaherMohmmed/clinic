<?php


namespace App\Http\Services;

use App\Constants\SettingTypes;
use App\Http\Repository\SettingRepository;
use App\Http\Services\SettingServiceHelper\AudioTypeService;
use App\Http\Services\SettingServiceHelper\ExstentionTypeService;
use App\Http\Services\SettingServiceHelper\ImageTypeService;
use App\Http\Services\SettingServiceHelper\VideoTypeService;
use Illuminate\Support\Arr;

class SettingUpdateService
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;
    /**
     * @var AudioTypeService
     */
    private $audioTypeService;
    /**
     * @var ImageTypeService
     */
    private $imageTypeService;
    /**
     * @var VideoTypeService
     */
    private $videoTypeService;
    /**
     * @var ExstentionTypeService
     */
    private $exstentionTypeService;

    /**
     * __construct
     *
     * @param  SettingRepository $settingRepository
     * @param  AudioTypeService $audioTypeService
     * @param  ImageTypeService $imageTypeService
     * @param  VideoTypeService $videoTypeService
     * @param  ExstentionTypeService $exstentionTypeService
     * @return void
     */
    public function __construct(
        SettingRepository $settingRepository,
        AudioTypeService $audioTypeService,
        ImageTypeService $imageTypeService,
        VideoTypeService $videoTypeService,
        ExstentionTypeService $exstentionTypeService
    ) {
        $this->settingRepository      = $settingRepository;
        $this->audioTypeService       = $audioTypeService;
        $this->imageTypeService       = $imageTypeService;
        $this->videoTypeService       = $videoTypeService;
        $this->exstentionTypeService  = $exstentionTypeService;
    }
    /**
     * handle function that make update for setting
     * @param array $request
     * @return Setting
     */
    public function handle($request, $setting)
    {
        if ($request['type_id'] == SettingTypes::ADVANCED_TEXT) {
            $request = array_merge($request, [
                'value' => $request['value']
            ]);
        }

        if ($request['type_id'] == SettingTypes::NORMAL_TEXT) {
            $request = array_merge($request, [
                'value' => $request['value']
            ]);
        }

        if (! isset($request['value'])) {
            if ($request['type_id'] == SettingTypes::IMAGE) {
                $request = array_merge($request, [
                    'value' => $this->imageTypeService->handle($request['Image'])
                ]);
            }

            if ($request['type_id'] == SettingTypes::VIDEO) {
                $request = array_merge($request, [
                    'value' => $this->videoTypeService->handle($request['Video'])
                ]);
            }
            if ($request['type_id'] == SettingTypes::AUDIO) {
                $request = array_merge($request, [
                    'value' => $this->audioTypeService->handle($request['Audio'])
                ]);
            }
        }

        if ($request['type_id'] == SettingTypes::EXSTENTION) {
            $request = array_merge($request, [
                'value' => $this->exstentionTypeService->handle($request['value'])
            ]);
        }

        if ($request['type_id'] == SettingTypes::SELECTOR) {
            $request = array_merge($request, [
                'value' => $request['value']
            ]);
        }

        $request = Arr::only($request, ['key', 'value', 'type_id', 'order']);

        $setting = $setting->update($request);

        return $setting;
    }
}
