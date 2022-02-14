<?php

namespace App\Traits;

trait DeleteFile
{
    /**
     * Make Observer For Delete Image From Any Model if this image change or model deleted
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            if(file_exists(base_path($model->image)))
            {
                unlink(base_path($model->image)) ;
            }
            if(file_exists(base_path($model->path)))
            {
                unlink(base_path($model->path)) ;
            }
            if(file_exists(base_path($model->image_preview)))
            {
                unlink(base_path($model->image_preview)) ;
            }
        });

        static::updated(function($model) {
            if (file_exists(base_path($model->image)) && request()->filled('image') && request()->hasFile('image')){
                unlink(base_path($model->image)) ;
            }
            if (file_exists(base_path($model->image_preview)) && request()->filled('image_preview') && request()->hasFile('image_preview')){
                unlink(base_path($model->image_preview)) ;
            }
            if (file_exists(base_path($model->path)) && request()->filled('path') && request()->hasFile('path')){
                unlink(base_path($model->path)) ;
            }
        });
    }
}
