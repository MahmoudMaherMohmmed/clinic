<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Repository\SettingRepository;
use App\Http\Repository\TypeRepository;
use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Http\Services\SettingStoreService;
use App\Http\Services\SettingUpdateService;
use App\Models\Setting;
use App\Models\Type;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * settingRepository
     *
     *
     * @var SettingRepository
     */
    private $settingRepository;
    /**
     * settingStoreService
     *
     * @var SettingStoreService
     */
    private $settingStoreService;
    /**
     * settingUpdateService
     *
     * @var SettingUpdateService
     */
    private $settingUpdateService;
    /**
     * typeRepository
     *
     * @var TypeRepository
     */
    private $typeRepository;
    /**
     * __construct
     *
     * @param  SettingRepository $settingRepository
     * @param  TypeRepository $typeRepository
     * @param  SettingStoreService $settingStoreService
     * @param  SettingUpdateService $settingUpdateService
     * @return void
     */
    public function __construct(
        SettingRepository $settingRepository,
        TypeRepository $typeRepository,
        SettingStoreService $settingStoreService,
        SettingUpdateService $settingUpdateService
    )
    {
        $this->get_privilege();
        $this->settingRepository = $settingRepository;
        $this->settingStoreService = $settingStoreService;
        $this->settingUpdateService = $settingUpdateService;
        $this->typeRepository = $typeRepository;
    }

    /**
     * index
     * get all setting data
     * @return View
     */
    public function index()
    {
        $settings = $this->settingRepository->with('type')->get();
        return view('setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  View
     */
    public function create()
    {
        $types = $this->typeRepository->all()->pluck('title','id');
        return view('setting.create',compact('types'));
    }

    /**
     * store setting data
     *
     * @param  SettingStoreRequest $request
     * @return Redirect
     */
    public function store(SettingStoreRequest $request)
    {
        $this->settingStoreService->handle($request->validated());

        $request->session()->flash('success', trans('messages.Added Successfully'));

        return redirect('setting');
    }

    /**
     * Show the form for editing the specified resource.
     * @param    int  $id
     * @return  View
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->with(['type'])->findOrfail($id);

        return view('setting.edit',compact('setting'));
    }

    /**
     * update
     *
     * @param  int $id
     * @param  SettingUpdateRequest $request
     * @return Redirect
     */
    public function update($id, SettingUpdateRequest $request)
    {
        $setting = $this->settingRepository->findOrfail($id);

        $this->settingUpdateService->handle($request->all(), $setting);

        $request->session()->flash('success', trans('messages.updated successfully'));

        return redirect('setting');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->findOrfail($id);

        $setting->delete();

        \Session::flash('success', trans('messages.has been deleted successfully'));

        return back();
    }

    //Function To Order Settings Tables
    public function updateOrder(Request $request)
    {
        $settings = Setting::all();

        foreach($settings as $setting)
        {
            $setting->timestamps = false; //To Disable Updated At

            $id = $setting->id; // Get The ID Of Content

            foreach($request->order as $order)
            {
                if($order['id'] == $id) //Update When ID = Content ID
                {
                    $setting->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200); // Return Json Response "Success"
    }
}
