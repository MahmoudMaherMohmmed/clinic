<?php

namespace  App\Http\Services\ContentServiceHelper;

class ContentTypeContext
{
    /**
     * @var ContentType
     */
    protected $contentType;

    /**
     * __construct
     *
     * @param  ContentType $contentType
     */
    public function __construct(ContentType $contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * apply
     * function to handle content type , each type have it's implement and return string that will save in databse
     * @param  UploadedFile|String $request
     * @return String
     */
    public function handleType($value)
    {
        return $this->contentType->handle($value);
    }
}
