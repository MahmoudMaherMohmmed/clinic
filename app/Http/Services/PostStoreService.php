<?php


namespace App\Http\Services;

use App\Http\Repository\ContentRepository;
use App\Http\Repository\PostRepository;

class PostStoreService
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
     * @return Void
     */
    public function handle($request)
    {
        $this->handleCreatPivotTablePost($request, $request['operator_id']);
    }

    /**
     * handleCreatPivotTablePost
     *
     * @param  array $operators
     * @param  array $request
     * @return void
     */
    public function handleCreatPivotTablePost($request, $operators)
    {
        $content = $this->contentRepository->findOrfail($request['content_id']);

        foreach ($operators as  $operator_id) {
            $content->operators()->attach($operator_id ,
                [
                    'url' => url('user/content/'.$request['content_id'].'?op_id='.$operator_id) ,
                    'published_date' => $request['published_date'],
                    'active' => $request['active'],
                    'user_id' => auth()->id()
                ]
            );
        }

    }

}
