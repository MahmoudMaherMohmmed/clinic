<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
class StaticTranslation extends Model
{
    protected $table = 'static_translations';
    protected $fillable = ["key_word"];

    public function languages()
    {
    	return $this->belongsToMany('App\Models\Language','static_bodies','static_translation_id','language_id')->withPivot('body');
    }

    public function translations()
    {
    	return $this->hasMany('App\Models\StaticBody');
    }

    public function getBody($locale='')
    {
    	if (!$locale) {
    		$language = Language::where('short_code',\App::getLocale())->first();
    	}else{
    		$language = Language::where('short_code',$locale)->first();
        }
        // return($language['id']);
    	return $this->translations()->where('language_id',$language['id'])->first()['body'];
    }

    public static function getBodyByKeyWord($key_word,$locale='')
    {
        if (!$key_word) {
            return " ";
        }

        if (!$locale) {
            $language = Language::where('short_code',\App::getLocale())->first();
        }else{
            $language = Language::where('short_code',$locale)->first();
        }

        $body = StaticTranslation::where('key_word',$key_word)->first()->translations()->where('language_id',$language->id)->first()->body;

        return $body;
    }
}
