<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 6/1/19
 * Time: 10:46 PM
 */

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use File;

class UploaderService
{
    /**
     * creatOurFolderPath , it's function just to create custom global folder like our need
     *
     * @param  string $folder
     * @return string
     */
    public function creatOurFolderPath($folder)
    {
        $date_path = date("Y") . '-' . date("m") . '-' . date("d") . '/';
        $path =  base_path().'/uploads/'.$folder.'/' . $date_path;

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        return ['path' => $path , 'date_path' => $date_path];
    }

    /**
     * Method upload
     *
     * @param UploadedFile $file
     * @param string $folder
     *
     * @return string
     */
    public function upload(UploadedFile $file, $folder)
    {
        $ourPath = $this->creatOurFolderPath($folder);

        $file_name = time().'.'.$file->getClientOriginalExtension();

        if ($file->move($ourPath['path'], $file_name)) {
            return 'uploads/'.$folder.'/'.$ourPath['date_path'].$file_name;
        }
    }
}
