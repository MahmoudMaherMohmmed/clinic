<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Repository\LanguageRepository;

use Validator;

class TermController extends Controller
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->get_privilege();
        $this->languageRepository    = $languageRepository;
    }

    public function index()
    {
        $terms = Term::all();
        $languages = $this->languageRepository->all();
        return view('term.index', compact('terms', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $term = null;
        $languages = $this->languageRepository->all();

        return view('term.form', compact('term', 'languages'));
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

        $term = new Term();
        $term->fill($request->except('description'));
    
        foreach ($request->description as $key => $value) {
            $term->setTranslation('description', $key, $value);
        }
        
        $term->save();
        \Session::flash('success', trans('messages.Added Successfully'));
        return redirect('/term');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $term = Term::findOrFail($id);
        return view('term.index', compact('term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Term::findOrFail($id);
        $languages = $this->languageRepository->all();
        return view('term.form', compact('term', 'languages'));
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

        $term = Term::findOrFail($id);
        $term->fill($request->except('description'));

        foreach ($request->description as $key => $value) {
            $term->setTranslation('description', $key, $value);
        }
        
        $term->save();

        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/term');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::find($id);
        $term->delete();

        return redirect()->back();
    }
}
