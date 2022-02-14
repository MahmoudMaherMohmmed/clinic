<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repository\CountryRepository;
use App\Http\Requests\CountryRequest;
use App\Http\Services\CountryService;

class CountryController extends Controller
{
    /**
     * countryRepository
     *
     * @var CountryRepository
     */
    private $countryRepository;
    /**
     * countryService
     *
     * @var CountryService
     */
    private $countryService;

    /**
     * __construct
     * inject needed data in constructor
     * @param  CountryRepository $countryRepository
     * @param  CountryService $countryService
     * @return void
     */
    public function __construct(CountryRepository $countryRepository, CountryService $countryService)
    {
        $this->get_privilege();
        $this->countryRepository    = $countryRepository;
        $this->countryService    = $countryService;
    }

    /**
     * get all country
     *
     * @return View
     */
    public function index()
    {
    	$countrys = $this->countryRepository->all();
    	return view('country.index',compact('countrys'));
    }

    /**
     * get page for create country
     *
     * @return View
     */
    public function create()
    {
        $country = null;
    	return view('country.form',compact('country'));
    }

    /**
     * store Country Data
     *
     * @param  CountryRequest $request
     * @return Redirect
     */




    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(CountryRequest $request)
    {
    	$country = $this->countryService->handle($request->validated());
    	$request->session()->flash('success', trans('messages.Added Successfully'));
    	return redirect('country');
    }

    /**
     * get page for update country
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
    	$country = $this->countryRepository->find($id);
    	return view('country.form',compact('country'));
    }

    /**
     * update Country Data
     *
     * @param  int $id
     * @param  CountryRequest $request
     * @return redirect
     */
    public function update($id,CountryRequest $request)
    {
    	$this->countryService->handle($request->validated(), $id);
    	$request->session()->flash('success', trans('messages.updated successfully'));
    	return redirect('country');
    }

    /**
     * remove country data
     *
     * @param  int $id
     * @return redirect
     */
    public function delete($id)
    {
    	$this->countryRepository->destroy($id);
    	\Session::flash('success', trans('messages.has been deleted successfully'));
    	return redirect('country');
    }
}
