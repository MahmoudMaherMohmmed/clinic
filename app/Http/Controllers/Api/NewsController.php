<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = $this->formatNews(News::get(), app()->getLocale());

        return response()->json(['news' => $news]);
    }

    private function formatNews($news, $lang){
        $news_array = [];
        $android_link = Setting::where('key', 'android_link')->first();
        $ios_link = Setting::where('key', 'ios_link')->first();

        foreach($news as $new){
            array_push($news_array, [
                'id' => $new->id,
                'title' => $new->getTranslation('title', $lang),
                'description' => $new->getTranslation('description', $lang),
                'image' => isset($new->image) && $new->image!=null ? url($new->image) : '',
                'created_at' => $new->created_at->diffForHumans(),
                'android_link' => isset($android_link)&&$android_link!=null ? $android_link->value : null,
                'ios_link' => isset($ios_link)&&$ios_link!=null ? $ios_link->value : null,
            ]);
        }

        return $news_array;
    }

    public function news($id, Request $request){
        $news_data = [];
        $news = News::where('id', $id)->first();

        if(isset($news) && $news!=null){
            $news_data = $this->formatOneNews($news, app()->getLocale());
        }

        return response()->json(['news' => $news_data], 200);
    }

    private function formatOneNews($news, $lang){
        $android_link = Setting::where('key', 'android_link')->first();
        $ios_link = Setting::where('key', 'ios_link')->first();
       
        $news_array = [
            'id' => $news->id,
            'title' => $news->getTranslation('title', $lang),
            'description' => $news->getTranslation('description', $lang),
            'image' => isset($news->image) && $news->image!=null ? url($news->image) : '',
            'created_at' => $news->created_at->diffForHumans(),
            'android_link' => isset($android_link)&&$android_link!=null ? $android_link->value : null,
            'ios_link' => isset($ios_link)&&$ios_link!=null ? $ios_link->value : null,
        ];

        return $news_array;
    }
}
