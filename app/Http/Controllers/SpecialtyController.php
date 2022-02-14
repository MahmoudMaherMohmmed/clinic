<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class SpecialtyController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'spcialties';
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
        $specialties = Specialty::all();
        $languages = $this->languageRepository->all();
        return view('specialty.index', compact('specialties', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialty = null;
        $languages = $this->languageRepository->all();

        return view('specialty.form', compact('specialty', 'languages'));
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
            'title' => 'required|array',
            'title.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $specialty = new Specialty();
        $specialty->fill($request->except('title', 'description', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $specialty->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            $specialty->setTranslation('title', $key, $value);
        }
    
        foreach ($request->description as $key => $value) {
            $specialty->setTranslation('description', $key, $value);
        }
        
        $specialty->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/specialty');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('specialty.index', compact('specialty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('specialty.form', compact('specialty', 'languages'));
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
            'title' => 'required|array',
            'title.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $specialty = Specialty::findOrFail($id);
        $specialty->fill($request->except('title, description', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($specialty->image) {
                $this->delete_image_if_exists(base_path('/uploads/specialties/' . basename($specialty->image)));
            }

            $specialty->image = $this->handleFile($request['image']);
        }

        foreach ($request->title as $key => $value) {
            $specialty->setTranslation('title', $key, $value);
        }
        foreach ($request->description as $key => $value) {
            $specialty->setTranslation('description', $key, $value);
        }
        
        $specialty->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/specialty');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty = Specialty::find($id);
        $specialty->delete();

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
