<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
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

        foreach($news as $new){
            array_push($news_array, [
                'id' => $new->id,
                'title' => $new->getTranslation('title', $lang),
                'description' => $new->getTranslation('description', $lang),
                'image' => isset($new->image) && $new->image!=null ? url($new->image) : '',
            ]);
        }

        return $news_array;
    }
}
