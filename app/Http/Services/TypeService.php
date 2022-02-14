<?php


namespace App\Http\Services;

use App\Http\Repository\TypeRepository;

class TypeService
{
    /**
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * __construct
     *
     * @param  TypeRepository $typeRepository
     * @return void
     */
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository  = $typeRepository;
    }
    /**
     * handle function that make update for type
     * @param array $request
     * @return Type
     */
    public function handle($request, $typeId = null)
    {
        $type = $this->typeRepository;
        if($typeId) {
            $type = $this->typeRepository->find($typeId);
        }

        $type->fill($request);

        $type->save();

    	return $type;
    }

}
