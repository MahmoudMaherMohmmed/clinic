<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Doctor;
use Illuminate\Http\Request;

use Validator;

class ReservationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->get_privilege();
    }

    public function index()
    {
        $reservations = Reservation::all();
        $clients = Client::all();
        $doctors = Doctor::all();
        return view('reservation.index', compact('reservations', 'clients', 'doctors'));
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
        $this->sendNotification($reservation);
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
        $reservation = Reservation::findOrFail($id);
        return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $clients = Client::all();
        $doctors = Doctor::all();
        return view('reservation.form', compact('reservation', 'clients', 'doctors'));
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
            'patient_name' => 'required',
            'phone_number' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reservation = Reservation::findOrFail($id);
        $reservation->fill($request->all());
        $reservation->save();

        $this->sendNotification($reservation);
        
        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('/reservation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $this->updateAppointmentStatus($reservation);
        $reservation->delete();

        return redirect()->back();
    }

    private function updateAppointmentStatus($reservation)
    {
        if($reservation->payment_type==1 && $reservation->status!=2){
            $bank_transfer = $reservation->bankTransfer;
            if(isset($bank_transfer) && $bank_transfer!=null){
                $bank_transfer->delete();
            }
        }

        $appointment = $reservation->appointment;
        $appointment->status = 0;
        $appointment->save();

        return true;
    }

    private function sendNotification($reservation){
        $client = Client::where('id', $reservation->client_id)->first();
        $notification = null;
        $title = null;
        $body = null;

        if($reservation->status == 1){
            $title = 'اضافة الطلب';
            $body = 'تم اضافة طلبك بنجاح سيتم مراجعة الطلب والتواصل معكم فى اقرب وقت ممكن.';
            $notification = array("title" => $title, "body" => $body);

        }elseif($reservation->status == 2){
            $title = 'قبول الطلب';
            $body = 'تم قبول طلبك بنجاح يمكنك الان مراجعة طلبك فى حجوزاتى وسيتم التواصل معكم قبيل موعد الحجز مباشر.';
            $notification = array("title" => $title, "body" => $body);
        }else{
            $title = 'الغاء الطلب';
            $body = 'تم الغاء طلبكم يرجى محاولت اضافة موعد مره اخرى او التواصل مع الاداره من خلال الارقام الموضحه فى التطبيق للاستفسار عن اسباب عدم قبول الطلب.';
            $notification = array("title" => $title, "body" => $body);
        }
        
        if(isset($client) && $client!=null){
            sendNotification($client->device_token, $notification);
            $this->saveNotifications($client->id, $title, $body);
        }

        return true;
    }

    private function saveNotifications($client_id, $title, $body){
        $notification = new Notification();
        $notification->client_id = $client_id;
        $notification->title = $title;
        $notification->body = $body;
        $notification->save();

        return true;
    }

}
