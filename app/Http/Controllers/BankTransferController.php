<?php

namespace App\Http\Controllers;

use App\Models\BankTransfer;
use Illuminate\Http\Request;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

use Validator;

class BankTransferController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'bank_transfers';
    /**
     * @var UploaderService
     */
    private $uploaderService;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(UploaderService $uploaderService)
    {
        $this->get_privilege();
        $this->uploaderService = $uploaderService;
    }

    public function index()
    {
        $bank_transfers = BankTransfer::all();
        return view('bank_transfer.index', compact('bank_transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_transfer = null;

        return view('bank_transfer.form', compact('bank_transfer'));
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
        $bank_transfer = BankTransfer::findOrFail($id);
        return view('bank_transfer.show', compact('bank_transfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank_transfer = BankTransfer::findOrFail($id);
        return view('bank_transfer.form', compact('bank_transfer'));
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
        $bank_transfer = BankTransfer::find($id);
        $bank_transfer->delete();

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
