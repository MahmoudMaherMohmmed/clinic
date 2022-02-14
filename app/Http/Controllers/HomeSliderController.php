<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;
use Validator;

class HomeSliderController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'home_sliders';
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
        $home_sliders = HomeSlider::all();
        $languages = $this->languageRepository->all();
        return view('home_slider.index', compact('home_sliders', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home_slider = null;
        $languages = $this->languageRepository->all();

        return view('home_slider.form', compact('home_slider', 'languages'));
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
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $home_slider = new HomeSlider();
        $home_slider->fill($request->except('title', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $home_slider->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            if($value!=null)
            {
                $home_slider->setTranslation('title', $key, $value);
            }
        }
        
        $home_slider->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/home_slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $home_slider = HomeSlider::findOrFail($id);
        return view('home_slider.index', compact('home_slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $home_slider = HomeSlider::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('home_slider.form', compact('home_slider', 'languages'));
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
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $home_slider = HomeSlider::findOrFail($id);
        $home_slider->fill($request->except('title', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($home_slider->image) {
                $this->delete_image_if_exists(base_path('/uploads/home_sliders/' . basename($home_slider->image)));
            }

            $home_slider->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            if($value!=null)
            {
                $home_slider->setTranslation('title', $key, $value);
            }
        }
       
        $home_slider->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/home_slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $home_slider = HomeSlider::find($id);
        $home_slider->delete();

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
