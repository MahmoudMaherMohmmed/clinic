<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repository\TypeRepository;
use App\Http\Requests\TypeRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Http\Services\TypeService;;

class TypeController extends Controller
{
    /**
     * typeRepository
     *
     * @var TypeRepository
     */
    private $typeRepository;
    /**
     * typeService
     *
     * @var TypeService
     */
    private $typeService;

    /**
     * __construct
     * inject needed data in constructor
     * @param  TypeRepository $typeRepository
     * @param  TypeService $typeService
     * @return void
     */
    public function __construct(TypeService $typeService, TypeRepository $typeRepository)
    {
        $this->get_privilege();
        $this->typeRepository    = $typeRepository;
        $this->typeService  = $typeService;

    }

    /**
     * index
     * indexes all types in view
     * @return View
     */
    public function index()
    {
        $types = $this->typeRepository->all();

        return view('types.index', compact('types'));
    }


    /**
     * create
     * return page for create
     * @return View
     */
    public function create()
    {
        $type = null;

        return view('types.input', compact('type'));
    }


    /**
     * store
     *
     * @param  TypeRequest $request
     * @return Redirect
     */
    public function store(TypeRequest $request)
    {
        $this->typeService->handle($request->validated());

        \Session::flash('success',trans('messages.Added Successfully'));

        return redirect('types/index');

    }

    /**
     * edit
     *
     * @param  Integer $id
     * @return View
     */
    public function edit($id)
    {
        $type = $this->typeRepository->find($id);

        return view('types.input', compact('type'));
    }


    /**
     * update
     *
     * @param  TypeUpdateRequest $request
     * @return Redirect
     */
    public function update(TypeRequest $request ,$id)
    {

        $this->typeService->handle($request->validated(), $id);

        \Session::flash('success',trans('messages.updated successfully'));

        return redirect('types/index');

    }


    /**
     * destroy
     *
     * @param  Integer $id
     * @return Reirect
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->findOrfail($id);

        $type->delete();

        \Session::flash('success',trans('messages.has been deleted successfully'));

        return redirect('types/index');
    }

}
