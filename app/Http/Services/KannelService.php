<?php


namespace App\Http\Services;

use App\Http\Repository\KannelRepository;
use Illuminate\Http\UploadedFile;

class KannelService
{
    /**
     * @var IMAGE_PATH
     */
	const IMAGE_PATH = 'kannels';

    /**
     * @var UploaderService
     */
    private $uploaderService;

    /**
     * @var KannelRepository
     */
    private $kannelRepository;

    /**
     * __construct
     *
     * @param  KannelRepository $kannelRepository
     * @return void
     */

    public function __construct(KannelRepository $kannelRepository, UploaderService $uploaderService)
    {
        $this->kannelRepository  = $kannelRepository;
        $this->uploaderService = $uploaderService;
    }

    /**
     * handle function that make update for kannel
     * @param array $request
     * @return Kannel
     */
    public function handle($request, $kannelId = null)
    {
        $kannel = $this->kannelRepository;

        if($kannelId) {
            $kannel = $this->kannelRepository->find($kannelId);
        }

        if(isset($request['image'])) {
            $request = array_merge($request, [
                'image' => $this->handleFile($request['image'])
            ]);
        }

        $kannel->fill($request);

        $kannel->save();

    	return $kannel;
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
