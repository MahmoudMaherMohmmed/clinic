<?php

namespace App\Http\Controllers;

use App\Models\Massara;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;

use Validator;

class MassaraController extends Controller
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->get_privilege();
        $this->languageRepository    = $languageRepository;
    }

    public function index()
    {
        $massaras = Massara::all();
        $languages = $this->languageRepository->all();
        return view('massara.index', compact('massaras', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $massara = null;
        $languages = $this->languageRepository->all();

        return view('massara.form', compact('massara', 'languages'));
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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $massara = new Massara();
        $massara->fill($request->except('description'));
    
        foreach ($request->description as $key => $value) {
            $massara->setTranslation('description', $key, $value);
        }
        
        $massara->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/massara');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $massara = Massara::findOrFail($id);
        return view('massara.index', compact('massara'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $massara = Massara::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('massara.form', compact('massara', 'languages'));
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
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $massara = Massara::findOrFail($id);
        $massara->fill($request->except('description'));

        foreach ($request->description as $key => $value) {
            $massara->setTranslation('description', $key, $value);
        }
        
        $massara->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/massara');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $massara = Massara::find($id);
        $massara->delete();

        return redirect()->back();
    }
}
