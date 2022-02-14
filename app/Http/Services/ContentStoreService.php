<?php


namespace App\Http\Services;

use App\Constants\ContentTypes;
use App\Http\Repository\ContentRepository;
use App\Http\Services\ContentServiceHelper\ContentTypeContext;
use App\Http\Services\ContentServiceHelper\AudioTypeService;
use App\Http\Services\ContentServiceHelper\ImageTypeService;
use App\Http\Services\ContentServiceHelper\VideoTypeService;
use App\Http\Services\ContentServiceHelper\YoutubeTypeService;
use App\Http\Services\ContentServiceHelper\ExternalLinkTypeService;
use App\Http\Services\ContentServiceHelper\AdvancedTextTypeService;
use App\Http\Services\ContentServiceHelper\NormalTextTypeService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

use File;

class ContentStoreService extends ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;
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
     * __construct
     *
     * @param  ContentRepository $contentRepository
     * @param  AudioTypeService $audioTypeService
     * @param  ImageTypeService $imageTypeService
     * @param  VideoTypeService $videoTypeService
     * @param  YoutubeTypeService $YoutubeTypeService
     * @param  UploaderService $uploaderService
     * @return void
     */
    public function __construct(
        ContentRepository $contentRepository,
        AudioTypeService $audioTypeService,
        ImageTypeService $imageTypeService,
        VideoTypeService $videoTypeService,
        YoutubeTypeService $YoutubeTypeService,
        UploaderService $uploaderService
    ) {
        $this->contentRepository      = $contentRepository;
        $this->audioTypeService       = $audioTypeService;
        $this->imageTypeService       = $imageTypeService;
        $this->videoTypeService       = $videoTypeService;
        $this->YoutubeTypeService     = $YoutubeTypeService;
        $this->uploaderService        = $uploaderService;
    }
    /**
     * handle function that make update for content
     * @param array $request
     * @param int|null $contentId
     * @return Content
     */
    public function handle($request)
    {
        $content = $this->contentRepository;

        // if ($contentId) {
        //     $content = $this->contentRepository->find($contentId);
        // }

        $contentTypeClass = sprintf("App\\Http\\Services\\ContentServiceHelper\\" . ContentTypes::getLabel($request['content_type_id']) . 'TypeService');

        $contentTypeStrategy  = new ContentTypeContext(new $contentTypeClass);

        if (isset($request['path'])) {
            $request = array_merge($request, [
                'path' => $contentTypeStrategy->handleType($request['path'])
            ]);
        }

        if (isset($request['image_preview'])) {
            $request = array_merge($request, [
                'image_preview' => $this->handleFile($request['image_preview'])
            ]);
        }

        if (isset($request['path'])) {
            if ($request['content_type_id'] == ContentTypes::VIDEO) {
                $request = array_merge($request, [
                    'image_preview' => $this->handleVideoImagePreview($request)
                ]);
            }
        }

        if ($request['content_type_id'] == ContentTypes::YOUTUBVIDEO) {
            $request = array_merge($request, [
                'image_preview' => $this->handleYoutubeImagePreview($request)
            ]);
        }

        $content = $this->transTitle($content, $request);
        $path = '';
        if ($request['content_type_id'] == ContentTypes::ADVANCED_TEXT || request()->get('content_type_id') == ContentTypes::NORMAL_TEXT) {
            $content = $this->transPath($content, $request);
            $path = 'path';
        }

        $content->fill(Arr::except($request, ['title', $path]));
        $content->save();

        return $content;
    }
}
