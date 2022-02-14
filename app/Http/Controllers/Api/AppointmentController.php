<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Reservation;
use App\Models\Bank;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Services\UploaderService;
use Illuminate\Http\UploadedFile;

class AppointmentController extends Controller
{
    /**
     * @var IMAGE_PATH
     */
    const IMAGE_PATH = 'bank_transfers';
    
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function doctorAppointments($doctor_id){

        $appointments = Appointment::where('doctor_id', $doctor_id)->where('status', 0)->get(['date', 'from', 'to']);

        return response()->json(['appointments' => $this->formateDoctorAppointments($appointments)], 200);
    }

    private function formateDoctorAppointments($appointments){
        $months = [];
        $days = [];

        $available_appointment_duration = $this->getAppointmentAvaliableDuration();

        $month_start_date = null;
        foreach($available_appointment_duration as $day){
            if(!isset($months[$day->format('Y M')])){
                $month_start_date = $day;
                $months[$day->format('Y M')] = [];
                $days[$day->format('D')] = [];
                
                $this->setMonthDaysArrayValues($days, $day, $appointments);
            }else{
                if(($month_start_date->diff($day)->days)+1 == $day->daysInMonth){
                    $this->setMonthDaysArrayValues($days, $day, $appointments);
                    $months[$day->format('Y M')] =  $days;
                    unset($days);
                }elseif(count($days)<7 && $month_start_date->diff($day)->days<7){
                    $days[$day->format('D')] = [];
                    $this->setMonthDaysArrayValues($days, $day, $appointments);
                }else{
                    $this->setMonthDaysArrayValues($days, $day, $appointments);
                }
            }
        }

        return $months;
    }

    private function getAppointmentAvaliableDuration(){
        $current_month = Carbon::now()->startOfMonth();
        $last_avaliable_duration = Carbon::now()->addMonths(2)->endOfMonth();

        $available_appointment_duration = CarbonPeriod::create($current_month, $last_avaliable_duration);

        return $available_appointment_duration;
    }

    private function setMonthDaysArrayValues(&$days, $day, $appointments){
        if($this->checkAppointmentDay($day, $appointments)){
            array_push($days[$day->format('D')], [$day->format('d')=>1]);
        }else{
            array_push($days[$day->format('D')], [$day->format('d')=>0]);
        }

        return true;
    }

    private function checkAppointmentDay($day, $appointments){
        foreach($appointments as $appointment){
            if($appointment->date >= Carbon::now()->format('Y-m-d') && $appointment->date == $day->format('Y-m-d')){
                return true;
            }
        }

        return false;
    }

    public function dayAppointments(Request $request){
        $appointments = [];

        if(isset($request->date) && $request->date!=null){
            if($this->formatDate($request->date) == Carbon::now()->format('Y-m-d')){
                $appointments = Appointment::where('doctor_id', $request->doctor_id)->where('date', $this->formatDate($request->date))->where('from', '>', Carbon::now()->format('H:i A'))->where('status', 0)->get(['id', 'from', 'to', 'status']);
            }else{
                $appointments = Appointment::where('doctor_id', $request->doctor_id)->where('date', $this->formatDate($request->date))->where('status', 0)->get(['id', 'from', 'to', 'status']);
            }
        }

        return response()->json(['appointments' => $appointments], 200);
    }

    private function formatDate($date){
        return Carbon::createFromFormat('Y M d', $date)->format('Y-m-d');
    }

    public function reserveAppointment(Request $request){
        $Validated = Validator::make($request->all(), [
            'appointment_id' => 'required',
            'patient_name' => 'required|min:3',
            'phone_number' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'description' => 'required',
            'payment_type' => 'required',
            'image'      => 'max:65536'
        ]);

        if($Validated->fails())
            return response()->json($Validated->messages(), 403);

        $reservation = new Reservation();
        $reservation->client_id = $request->user()->id;
        $reservation->fill($request->only('appointment_id', 'patient_name', 'phone_number', 'gender', 'age', 'description', 'payment_type'));
        if($reservation->save()){

            if($reservation->payment_type == 1){
                $this->saveBankTransfer($request, $reservation->id);
            }

            $this->updateAppointmentStatus($request->appointment_id);

            return response()->json(['message' => 'appointment reserved successfully.'], 200);
        }else{
            return response()->json(['message' => 'an error occurred.'], 200);
        }  
    }

    private function updateAppointmentStatus($appointment_id){
        $appointment = Appointment::where('id', $appointment_id)->first();
        $appointment->status = 1;
        $appointment->save();

        return true;
    }

    private function saveBankTransfer($request, $reservation_id){
        $bank = Bank::where('id', $request->bank_id)->first();

        if(isset($bank) && $bank!=null){
            $bank_transfer = New BankTransfer();
            $bank_transfer->reservation_id = $reservation_id;
            $bank_transfer->bank_name = $bank->name;
            $bank_transfer->bank_account_name = $bank->account_name;
            $bank_transfer->bank_account_number = $bank->account_number;
            $bank_transfer->IBAN = $bank->IBAN;
            $bank_transfer->image = $this->handleFile($request['image']);
            $bank_transfer->save();
        }

        return true;
    }

    public function clientReservations(Request $request){
        $client_id = $request->user()->id;
        $reservations_array = [];

        $reservations = Reservation::where('client_id', $client_id)->get();
        if(isset($reservations) && $reservations!=null){
            foreach($reservations as $reservation){
                if(isset($reservation->appointment) && $reservation->appointment!=null && isset($reservation->appointment->doctor) && $reservation->appointment->doctor!=null)
                {
                    array_push($reservations_array, $this->formatReservation($reservation, $request->lang));
                }
            }
        }

        return response()->json(['reservations' => $reservations_array], 200);
    }

    private function formatReservation($reservation, $lang){
        $reservation = [
            'order_id' => '#'.$reservation->id,
            'doctor' => isset($lang) && $lang!=null ? $reservation->appointment->doctor->getTranslation('name', $lang) : $reservation->appointment->doctor->name,
            'doctor_image' => $reservation->appointment->doctor->image != null ? url($reservation->appointment->doctor->image) : '',
            'specialty' => isset($lang) && $lang!=null ? $reservation->appointment->doctor->specialty->getTranslation('title', $lang) : $reservation->appointment->doctor->specialty->title,
            'subspecialty' => isset($lang) && $lang!=null ? $reservation->appointment->doctor->getTranslation('subspecialty', $lang) : $reservation->appointment->doctor->subspecialty,
            'medical_examination_price' => $reservation->appointment->doctor->medical_examination_price,
            'date' => $reservation->appointment->date,
            'from' => $reservation->appointment->from,
            'to' => $reservation->appointment->to,
        ];

        return $reservation;
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
