<?php

namespace  App\Http\Services\ContentServiceHelper;

interface ContentType
{
    /**
     * apply
     * function to handle content type , each type have it's implement and return string that will save in databse
     * @param  UploadedFile|String $request
     * @return String
     */
    public function handle($value);
}
