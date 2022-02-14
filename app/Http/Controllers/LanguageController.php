<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repository\LanguageRepository;
use App\Http\Requests\LanguageRequest;
use App\Http\Services\LanguageService;
use Illuminate\Support\Facades\Session;
use Config;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Config as FlysystemConfig;

class LanguageController extends Controller
{
    /**
     * languageRepository
     *
     * @var LanguageRepository
     */
    private $languageRepository;
    /**
     * languageService
     *
     * @var LanguageService
     */
    private $languageService;

    /**
     * __construct
     * inject needed data in constructor
     * @param  LanguageRepository $languageRepository
     * @param  LanguageService $languageService
     * @return void
     */
    public function __construct(LanguageRepository $languageRepository, LanguageService $languageService)
    {
        $this->get_privilege();
        $this->languageRepository    = $languageRepository;
        $this->languageService    = $languageService;
    }

    /**
     * switchLang
     *
     * @param  string $lang
     * @return void
     */
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    /**
     * get all language
     *
     * @return View
     */
    public function index()
    {
    	$languages = $this->languageRepository->all();
    	return view('language.index',compact('languages'));
    }

    /**
     * get page for create language
     *
     * @return View
     */
    public function create()
    {
    	return view('language.create');
    }

    /**
     * store Language Data
     *
     * @param  LanguageRequest $request
     * @return Redirect
     */
    public function store(LanguageRequest $request)
    {
    	$language = $this->languageService->handle($request->validated());
    	$request->session()->flash('success', trans('messages.Added Successfully'));
    	return redirect('language');
    }

    /**
     * get page for update language
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
    	$language = $this->languageRepository->find($id);
    	return view('language.create',compact('language'));
    }

    /**
     * update Language Data
     *
     * @param  int $id
     * @param  LanguageRequest $request
     * @return redirect
     */
    public function update($id,LanguageRequest $request)
    {
    	$this->languageService->handle($request->validated(), $id);
    	$request->session()->flash('success', trans('messages.updated successfully'));
    	return redirect('language');
    }

    /**
     * remove language data
     *
     * @param  int $id
     * @return redirect
     */
    public function destroy($id)
    {
    	$this->languageRepository->destroy($id);
    	\Session::flash('success', trans('messages.has been deleted successfully'));
    	return redirect('language');
    }
}
