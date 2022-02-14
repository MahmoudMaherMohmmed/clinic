<?php


namespace App\Http\Services;

use App\Http\Repository\OperatorRepository;
use Illuminate\Http\UploadedFile;

class OperatorService
{
    /**
     * @var IMAGE_PATH
     */
	const IMAGE_PATH = 'operators';
    /**
     * @var UploaderService
     */
    private $uploaderService;
    /**
     * @var OperatorRepository
     */
    private $operatorRepository;

    /**
     * __construct
     *
     * @param  OperatorRepository $operatorRepository
     * @return void
     */
    public function __construct(OperatorRepository $operatorRepository, UploaderService $uploaderService)
    {
        $this->operatorRepository  = $operatorRepository;
        $this->uploaderService = $uploaderService;
    }
    /**
     * handle function that make update for operator
     * @param array $request
     * @return Operator
     */
    public function handle($request, $operatorId = null)
    {
        $operator = $this->operatorRepository;

        if($operatorId) {
            $operator = $this->operatorRepository->find($operatorId);
        }

        if(isset($request['image'])) {
            $request = array_merge($request, [
                'image' => $this->handleFile($request['image'])
            ]);
        }

        $operator->fill($request);

        $operator->save();

    	return $operator;
    }

    /**
     * handle image file that return file path
     * @param File $file
     * @return string
     */
    public function handleFile(UploadedFile $file)
    {
        return $this->uploaderService->upload($file, self::IMAGE_PATH);
    }

}
