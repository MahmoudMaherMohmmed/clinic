<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;


class ContentService
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'content/image_preview';
    /**
    /**
     * Method transTitle
     *
     * @param content $category [explicite description]
     *
     * @return content
     */
    public function transTitle($content, $request)
    {
        foreach ($request['title'] as $key => $value) {
            $content->setTranslation('title', $key, $value);
        }
        return $content;
    }


    /**
     * Method transPath
     *
     * @param $content $content [explicite description]
     *
     * @return content
     */
    public function transPath($content, $request)
    {
        foreach ($request['path'] as $key => $value) {
            $content->setTranslation('path', $key, $value);
        }
        return $content;
    }

    /**
     * handle image file that return file path
     * @param File $file
     * @return string
     */
    public function handleFile(UploadedFile $file)
    {
        return $this->uploaderService->upload($file, self::IMAGE_PATH);
    }
    /**
     * handle Video Image Preview that return file path
     * @param array $request
     * @return string
     */
    public function handleVideoImagePreview($request)
    {
        // $request['path'] = '';
        $ourPath = $this->uploaderService->creatOurFolderPath(self::IMAGE_PATH);
        $image_path =  'uploads/' . self::IMAGE_PATH . '/' . $ourPath['date_path'] . time() . '.png';
        $command = 'ffmpeg -ss 00:00:02 -i ' . base_path($request['path']) . ' -vframes 1 -q:v 2 ' . base_path($image_path) . '';
        $command = str_replace('\\', '/', $command);
        exec($command);
        return $image_path;
    }
    /**
     * handle Youtube Image Preview that return file path
     * @param array $request
     * @return string
     */
    public function handleYoutubeImagePreview($request)
    {
        $ourPath = $this->uploaderService->creatOurFolderPath(self::IMAGE_PATH);
        $image_path =  'uploads/' . self::IMAGE_PATH . '/' . $ourPath['date_path'] . time() . rand(0, 999) . '.png';
        // dd($image_path);
        $link = explode('embed/', $request['path']);
        if (isset($link[1])) {
            $youtube_id = explode('?', $link[1]);
            file_put_contents(base_path($image_path), file_get_contents('http://img.youtube.com/vi/' . $youtube_id[0] . '/maxresdefault.jpg'));
        } else {
            $link = explode('?v=', $request['path']);
            file_put_contents(base_path($image_path), file_get_contents('http://img.youtube.com/vi/' . $link[1] . '/maxresdefault.jpg'));
            request()->request->add(['path' => 'http://www.youtube.com/embed/' . $link[1] . '?rel=0']);
        }
        return $image_path;
    }
}
