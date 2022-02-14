<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class CenterController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'centers';
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
        $centers = Center::all();
        $languages = $this->languageRepository->all();
        return view('center.index', compact('centers', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $center = null;
        $languages = $this->languageRepository->all();

        return view('center.form', compact('center', 'languages'));
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
            'description' => 'required|array',
            'description.*' => 'required|string',
            'working_days' => 'required|array',
            'working_days.*' => 'required|string',
            'from' => 'required',
            'to' => 'required',
            'email' => 'required|email',
            'contact_email' => 'required|email',
            'phone_1' => 'required',
            'phone_2' => 'required',
            'facebook_link' => 'required',
            'whatsapp_link' => 'required',
            'instagram_link' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'logo' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $center = new Center();
        $center->fill($request->except('description', 'working_days', 'logo'));

        if ($request->logo) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->logo;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $center->logo = $this->handleFile($request['logo']);
        }
    
        foreach ($request->description as $key => $value) {
            $center->setTranslation('description', $key, $value);
        }

        $center->working_days = $this->getWorkingDaysString($request->working_days);
        
        $center->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/center');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center = Center::findOrFail($id);
        return view('center.index', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = Center::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('center.form', compact('center', 'languages'));
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
            'description' => 'required|array',
            'description.*' => 'required|string',
            'working_days' => 'required|array',
            'working_days.*' => 'required|string',
            'from' => 'required',
            'to' => 'required',
            'email' => 'required|email',
            'contact_email' => 'required|email',
            'phone_1' => 'required',
            'phone_2' => 'required',
            'facebook_link' => 'required',
            'whatsapp_link' => 'required',
            'instagram_link' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'logo' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $center = Center::findOrFail($id);
        $center->fill($request->except('description', 'working_days', 'ímage'));

        if ($request->logo) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->logo;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($center->logo) {
                $this->delete_image_if_exists(base_path(basename($center->logo)));
            }

            $center->logo = $this->handleFile($request['logo']);
        }

        foreach ($request->description as $key => $value) {
            $center->setTranslation('description', $key, $value);
        }

        $center->working_days = $this->getWorkingDaysString($request->working_days);
        
        $center->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/center');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center = Center::find($id);
        $center->delete();

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

    private function getWorkingDaysString($working_days){
        $working_days_string = '';

        foreach($working_days as $key=>$value){
            if( $key!= 0 ) {
                $working_days_string .= ', ';
            }

            $working_days_string .= $value;
        }

        return $working_days_string;
    }
}
