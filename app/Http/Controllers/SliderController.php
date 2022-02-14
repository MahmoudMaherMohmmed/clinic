<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class SliderController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'sliders';
    /**
     * @var UploaderService
     */
    private $uploaderService;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(LanguageRepository $languageRepository, UploaderService $uploaderService)
    {
        $this->get_privilege();
        $this->languageRepository    = $languageRepository;
        $this->uploaderService = $uploaderService;
    }

    public function index()
    {
        $sliders = Slider::all();
        $languages = $this->languageRepository->all();
        return view('slider.index', compact('sliders', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slider = null;
        $languages = $this->languageRepository->all();

        return view('slider.form', compact('slider', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'array',
            'title.*' => 'string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $slider = new Slider();
        $slider->fill($request->except('title', 'description', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $slider->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            $slider->setTranslation('title', $key, $value);
        }
    
        foreach ($request->description as $key => $value) {
            $slider->setTranslation('description', $key, $value);
        }
        
        $slider->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return view('slider.index', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('slider.form', compact('slider', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'array',
            'title.*' => 'string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $slider = Slider::findOrFail($id);
        $slider->fill($request->except('title, description', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($slider->image) {
                $this->delete_image_if_exists(base_path('/uploads/sliders/' . basename($slider->image)));
            }

            $slider->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            $slider->setTranslation('title', $key, $value);
        }
        foreach ($request->description as $key => $value) {
            $slider->setTranslation('description', $key, $value);
        }
        
        $slider->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        return redirect()->back();
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
