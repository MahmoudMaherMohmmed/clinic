<?php


namespace App\Http\Services;

use App\Http\Repository\ContentTypeRepository;

class ContentTypeService
{
    /**
     * @var ContentTypeRepository
     */
    private $contentTypeRepository;

    /**
     * __construct
     *
     * @param  ContentTypeRepository $contentTypeRepository
     * @return void
     */
    public function __construct(ContentTypeRepository $contentTypeRepository)
    {
        $this->contentTypeRepository  = $contentTypeRepository;
    }
    /**
     * handle function that make update for contentType
     * @param array $request
     * @return ContentType
     */
    public function handle($request, $contentTypeId = null)
    {
        $contentType = $this->contentTypeRepository;

        if($contentTypeId) {
            $contentType = $this->contentTypeRepository->find($contentTypeId);
        }

        $contentType->fill($request);

        $contentType->save();

    	return $contentType;
    }

}
