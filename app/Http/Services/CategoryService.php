<?php


namespace App\Http\Services;

use App\Http\Repository\CategoryRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class CategoryService
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'categories';
    /**
     * @var UploaderService
     */
    private $uploaderService;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * __construct
     *
     * @param  CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository, UploaderService $uploaderService)
    {
        $this->categoryRepository  = $categoryRepository;
        $this->uploaderService = $uploaderService;
    }
    /**
     * handle function that make update for category
     * @param array $request
     * @return Category
     */
    public function handle($request, $categoryId = null)
    {

        $category = $this->categoryRepository;

        if ($categoryId) {
            $category = $this->categoryRepository->find($categoryId);
        }

        if (isset($request['image'])) {
            $request = array_merge($request, [
                'image' => $this->handleFile($request['image'])
            ]);
        }
        $category = $this->transTitle($category, $request);
        $category->fill(Arr::except($request, ['title']));

        $category->save();

        return $category;
    }

    /**
     * Method transTitle
     *
     * @param Category $category [explicite description]
     *
     * @return Category
     */
    public function transTitle($category, $request)
    {
        foreach ($request['title'] as $key => $value) {
            $category->setTranslation('title', $key, $value);
        }
        return $category;
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
