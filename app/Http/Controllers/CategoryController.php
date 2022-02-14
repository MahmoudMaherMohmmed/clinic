<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Filters\CategoryFilter\ParentFilter;
use App\Http\Repository\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Http\Repository\LanguageRepository;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * languageRepository
     *
     * @var LanguageRepository
     */
    private $languageRepository;
    /**

    /**
     * categoryRepository
     *
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * categoryService
     *
     * @var CategoryService
     */
    private $categoryService;

    /**
     * __construct
     * inject needed data in constructor
     * @param  CategoryRepository $categoryRepository
     * @param  CategoryService $categoryService
     * @param  LanguageRepository $languageRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryService $categoryService, LanguageRepository $languageRepository)
    {
        $this->get_privilege();
        $this->categoryRepository    = $categoryRepository;
        $this->categoryService       = $categoryService;
        $this->languageRepository    = $languageRepository;
    }

    /**
     * get all category
     *
     * @return View
     */
    public function index(Request $request)
    {
        $parentTitle = '';
        if ($request->filled('parent_id')) {
            $parentTitle  = $this->categoryRepository->select('title')->where("id", $request->parent_id)->first()->title;
        }
        $languages = $this->languageRepository->all();
        return view('category.index', compact('parentTitle', 'languages'));
    }

    /**
     * Method allData
     *
     * @param \Illuminate\Http\Request $request (parent_id)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allData(Request $request)
    {
        $categorys = $this->categoryRepository
            ->withCount(['contents', 'sub_cats'])
            ->filter($this->categoryFilter());

        if (!$request->filled("parent_id")) {
            $categorys = $categorys->parent();
        }

        return \DataTables::eloquent($categorys)
            ->addColumn('index', function (Category $category) {
                return '<input type="checkbox" name="selected_rows[]" value="' . $category->id . '" class="roles select_all_template">';
            })
            ->addColumn('id', function (Category $category) {
                return $category->id;
            })
            ->addColumn('title', function (Category $category) {
                return '<ul>
                        <li> <span style="font-weight: bold;">EN: </span>' . $category->getTranslation("title", "en") . '</li>
                        <li><span style="font-weight: bold;">AR: </span> ' . $category->getTranslation("title", "ar") . '</li>
                        </ul>';
            })
            ->addColumn('image', function (Category $category) {

                if ($category->image) {
                    return "<img src='$category->image' alt='$category->title' style='width:100px' height='100px'>";
                } else {
                    return "<img src='https://ui-avatars.com/api/?name=$category->title' alt='$category->title' style='width:100px' height='100px'>";
                }
            })
            ->addColumn('action', function (Category $value) {
                return view('category.action', compact('value'))->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * get page for create category
     *
     * @return View
     */
    public function create()
    {
        $category = null;
        $parents = $this->categoryRepository->parent()->when(request()->category_id, function ($query) {
            return $query->where('id', request()->category_id);
        })->get();
        $languages = $this->languageRepository->all();
        return view('category.form', compact('category', 'parents', 'languages'));
    }

    /**
     * store Category Data
     *
     * @param  CategoryStoreRequest $request
     * @return Redirect
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->handle($request->validated());
        $request->session()->flash('success', trans('messages.Added Successfully'));
        if ($request->has('parent_id')) {
            return redirect('category?parent_id=' . $request->parent_id . '');
        }
        return redirect('category');
    }



    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $parents = $this->categoryRepository->parent()->get();
        $languages = $this->languageRepository->all();
        return view('category.form', compact('category', 'parents', 'languages'));
    }

    /**
     * update Category Data
     *
     * @param  int $id
     * @param  CategoryUpdateRequest $request
     * @return redirect
     */
    public function update($id, CategoryRequest $request)
    {
        $this->categoryService->handle($request->validated(), $id);
        $request->session()->flash('success', trans('messages.updated successfully'));
        if ($request->has('parent_id')) {
            return redirect('category?parent_id=' . $request->parent_id . '');
        }
        return redirect('category');
    }

    /**
     * remove category data
     *
     * @param  int $id
     * @return redirect
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);
        $this->categoryRepository->destroy($id);
        \Session::flash('success', trans('messages.has been deleted successfully'));
        if ($category->parent_id) {
            return redirect('category?parent_id=' . $category->parent_id . '');
        }
        return redirect('category');
    }

    /**
     * Method categoryFilter
     *
     * @return array
     */
    public function categoryFilter()
    {
        return [
            'parent_id' => new ParentFilter
        ];
    }
}
