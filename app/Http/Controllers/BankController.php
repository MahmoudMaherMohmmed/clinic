<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class BankController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'banks';
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
        $banks = Bank::all();
        $languages = $this->languageRepository->all();
        return view('bank.index', compact('banks', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank = null;
        $languages = $this->languageRepository->all();

        return view('bank.form', compact('bank', 'languages'));
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
            'account_name' => 'required',
            'account_number' => 'required',
            'IBAN' => 'required',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bank = new Bank();
        $bank->fill($request->except('name', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            $bank->image = $this->handleFile($request['image']);
        }

        foreach ($request->name as $key => $value) {
            $bank->setTranslation('name', $key, $value);
        }
    
        $bank->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return view('bank.index', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('bank.form', compact('bank', 'languages'));
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
            'account_name' => 'required',
            'account_number' => 'required',
            'IBAN' => 'required',
            'image' => ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bank = Bank::findOrFail($id);

        $bank->fill($request->except('name', 'ímage'));

        if ($request->image) {
            $imgExtensions = array("png", "jpeg", "jpg");
            $file = $request->image;
            if (!in_array($file->getClientOriginalExtension(), $imgExtensions)) {
                \Session::flash('failed', trans('messages.Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..'));
                return back();
            }

            if ($bank->image) {
                $this->delete_image_if_exists(base_path('/uploads/banks/' . basename($bank->image)));
            }

            $bank->image = $this->handleFile($request['image']);
        }

        foreach ($request->name as $key => $value) {
            $bank->setTranslation('name', $key, $value);
        }
        
        $bank->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

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
