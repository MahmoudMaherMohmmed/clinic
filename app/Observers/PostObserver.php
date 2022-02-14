<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $id = Post::latest()->first()->id;
        Post::find($id)->update(['url' => url('user/content/'.$post->content_id.'?op_id='.$post->operator_id.'&post_id='.$id)]);
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        $post->url = url('user/content/'.request('content_id').'?op_id='.$post->operator_id.'&post_id='.$post->id);
        $post->user_id = auth()->id();
    }
}
