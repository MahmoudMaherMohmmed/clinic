<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Repository\LanguageRepository;
use App\Http\Repository\StaticTranslationRepository;
use App\Http\Requests\StaticTranslationRequest;
use App\Http\Services\StaticTranslationService;
use App\Models\StaticTranslation;
use App\Models\Language;
use Validator;

class StaticTranslationController extends Controller
{
    /**
     * staticTraslationRepository
     *
     * @var StaticTranslationRepository
     */
    private $staticTraslationRepository;
    /**
     * languageRepository
     *
     * @var LanguageRepository
     */
    private $languageRepository;
    /**
     * staticTraslationService
     *
     * @var StaticTranslationService
     */
    private $staticTraslationService;

    /**
     * __construct
     * inject needed data in constructor
     * @param  StaticTranslationRepository $staticTraslationRepository
     * @param  StaticTranslationRepository $languageRepository
     * @param  LanguageRepository $staticTraslationService
     * @return void
     */
    public function __construct(StaticTranslationService $staticTraslationService, StaticTranslationRepository $staticTraslationRepository,LanguageRepository $languageRepository)
    {
        $this->get_privilege();
        $this->staticTraslationRepository    = $staticTraslationRepository;
        $this->languageRepository    = $languageRepository;
        $this->staticTraslationService  = $staticTraslationService;

    }
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        $static_translations = $this->staticTraslationRepository->all();
        $languages = $this->languageRepository->all();
        return view('static_translation.index',compact('static_translations','languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $languages = $this->languageRepository->all();
        return view('static_translation.create',compact('languages'));
    }

    /**
     * store
     *
     * @param  StaticTranslationRequest $request
     * @return Redirect
     */
    public function store(StaticTranslationRequest $request)
    {
        $this->staticTraslationService->handle($request->validated());
        $request->session()->flash('success', trans('messages.Added Successfully'));
        return redirect('static_translation');
    }

    /**
     * show
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        $static_translation = $this->staticTraslationRepository->findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('static_translation.view',compact('languages','static_translation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $static_translation = $this->staticTraslationRepository->findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('static_translation.create',compact('languages','static_translation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StaticTranslationRequest $request
     * @param  int $id
     * @return Redirect
     */
    public function update(StaticTranslationRequest $request, $id)
    {
        $this->staticTraslationService->handle($request->validated(), $id);
        $request->session()->flash('success', trans('messages.updated successfully'));
        return redirect('static_translation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirect
     */
    public function destroy($id,Request $request)
    {
        $static_translation = $this->staticTraslationRepository->findOrFail($id);
        $static_translation->delete();
        $request->session()->flash('success', trans('messages.has been deleted successfully'));
        return redirect('static_translation');
    }
}
