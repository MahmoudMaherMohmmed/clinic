<?php


namespace App\Http\Services;

use App\Http\Repository\ContentRepository;
use App\Http\Repository\RbtRepository;

class RbtService
{
    /**
     * @var RbtRepository
     */
    private $rbtRepository;

    /**
     * __construct
     *
     * @param  RbtRepository $rbtRepository
     * @return void
     */
    public function __construct(RbtRepository $rbtRepository, ContentRepository $contentRepository)
    {
        $this->rbtRepository  = $rbtRepository;
        $this->contentRepository  = $contentRepository;
    }
    /**
     * handle function that make update for rbtCode
     * @param array $request
     * @return RbtCode
     */
    public function handle($request, $rbtCodeId = null)
    {
        $rbtCode = $this->rbtRepository;

        if($rbtCodeId) {
            $rbtCode = $this->rbtRepository->find($rbtCodeId);
            $rbtCode->fill($request);
            $rbtCode->save();
        } else {
            $content = $this->contentRepository->findOrFail($request['content_id']);
            foreach ($request['operator_id'] as  $key => $operator_id) {
                $content->rbt_operators()->attach([
                    $operator_id => [
                        'rbt_code' => $request['rbt_code'][$key]
                    ]
                ]);
            }
        }

    	return $rbtCode;
    }

}
