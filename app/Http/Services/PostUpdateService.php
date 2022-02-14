<?php


namespace App\Http\Services;

use App\Http\Repository\ContentRepository;
use App\Http\Repository\PostRepository;

class PostUpdateService
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * PostServices constructor.
     * PostRepository constructor.
     */
    public function __construct(PostRepository $postRepository, ContentRepository $contentRepository)
    {
        $this->postRepository  = $postRepository;
        $this->contentRepository  = $contentRepository;
    }
    /**
     * handle function that make create for post
     * @param array $request
     * @return Post
     */
    public function handle($request, $post)
    {
        $request = array_merge($request, [
            'operator_id' => $request['operator_id'][0]
        ]);

        $post = tap($post)->update($request);

    	return $post;
    }

}
