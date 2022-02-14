<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class DoctorController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'doctors';
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
        $doctors = Doctor::all();
        $languages = $this->languageRepository->all();
        return view('doctor.index', compact('doctors', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor = null;
        $specialties = Specialty::all();
        $languages = $this->languageRepository->all();

        return view('doctor.form', compact('doctor', 'specialties', 'languages'));
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
            'name' => 'required|array',
            'name.*' => 'required|string',
            'subspecialty' => 'required|array',
            'subspecialty.*' => 'required|string',
            'medical_examination_price' => 'required',
            'graduation_university' => 'required|array',
            'graduation_university.*' => 'required|string',
            'specialty_id' => 'required',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $doctor = new Doctor();
        $doctor->fill($request->except('name', 'subspecialty', 'graduation_university', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $doctor->image = $this->handleFile($request['image']);
        }

        foreach ($request->name as $key => $value) {
            $doctor->setTranslation('name', $key, $value);
        }
    
        $doctor->specialty_id = $request->specialty_id;

        foreach ($request->subspecialty as $key => $value) {
            $doctor->setTranslation('subspecialty', $key, $value);
        }

        foreach ($request->graduation_university as $key => $value) {
            $doctor->setTranslation('graduation_university', $key, $value);
        }
        
        $doctor->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/doctor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctor.index', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialties = Specialty::all();
        $languages = $this->languageRepository->all();
        return view('doctor.form', compact('doctor', 'specialties', 'languages'));
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
            'name' => 'required|array',
            'name.*' => 'required|string',
            'subspecialty' => 'required|array',
            'subspecialty.*' => 'required|string',
            'medical_examination_price' => 'required',
            'graduation_university' => 'required|array',
            'graduation_university.*' => 'required|string',
            'specialty_id' => 'required',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $doctor = Doctor::findOrFail($id);

        $doctor->fill($request->except('name', 'subspecialty', 'graduation_university', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($doctor->image) {
                $this->delete_image_if_exists(base_path('/uploads/doctors/' . basename($doctor->image)));
            }

            $doctor->image = $this->handleFile($request['image']);
        }

        foreach ($request->name as $key => $value) {
            $doctor->setTranslation('name', $key, $value);
        }

        $doctor->specialty_id = $request->specialty_id;
    
        foreach ($request->subspecialty as $key => $value) {
            $doctor->setTranslation('subspecialty', $key, $value);
        }

        foreach ($request->graduation_university as $key => $value) {
            $doctor->setTranslation('graduation_university', $key, $value);
        }
        
        $doctor->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

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
