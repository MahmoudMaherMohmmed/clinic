<?php


namespace App\Http\Services;

use App\Http\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UserUpdateService
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'profile_images';
    /**
     * @var UploaderService
     */
    private $uploaderService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserServices constructor.
     * UserRepository constructor.
     */
    public function __construct(UserRepository $userRepository, UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
        $this->userRepository  = $userRepository;
    }
    /**
     * handle function that make create for user
     * @param array $request
     * @return User
     */
    public function handle($request, $user)
    {
        if (isset($request['image'])) {
            $request = array_merge($request, [
                'image' => $this->handleFile($request['image'])
            ]);
        }

        $user  =  $this->userRepository->find($user->id);

        $user = tap($user, function ($user)  use ($request) {
            $user->update($request);
        });

        if (isset($request['role']))
            $user->syncRoles([$request['role']]);

        return $user;
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
