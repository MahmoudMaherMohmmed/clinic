<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Reservation;
use App\Models\Bank;
use App\Models\Doctor;
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

    public function appointments(){
        $months = [];
        $days = [];
        $available_appointment_duration = $this->getAppointmentAvaliableDuration();
        $working_days = $this->getWorkingDays();

        $month_start_date = null;
        foreach($available_appointment_duration as $day){
            if(!isset($months[$day->format('Y M')])){
                $month_start_date = $day;
                $months[$day->format('Y M')] = [];
                $days[$day->format('D')] = [];
                
                $this->setMonthDaysArrayValues($days, $day, $working_days);
            }else{
                if(($month_start_date->diff($day)->days)+1 == $day->daysInMonth){
                    $this->setMonthDaysArrayValues($days, $day, $working_days);
                    $months[$day->format('Y M')] =  $days;
                    unset($days);
                }elseif(count($days)<7 && $month_start_date->diff($day)->days<7){
                    $days[$day->format('D')] = [];
                    $this->setMonthDaysArrayValues($days, $day, $working_days);
                }else{
                    $this->setMonthDaysArrayValues($days, $day, $working_days);
                }
            }
        }

        return response()->json(['appointments' => $months], 200);
    }

    private function getAppointmentAvaliableDuration(){
        $current_month = Carbon::now()->startOfMonth();
        $last_avaliable_duration = Carbon::now()->addMonths(2)->endOfMonth();

        $available_appointment_duration = CarbonPeriod::create($current_month, $last_avaliable_duration);

        return $available_appointment_duration;
    }

    private function setMonthDaysArrayValues(&$days, $day, $working_days){
        if($this->checkAppointmentDay($day, $working_days)){
            array_push($days[$day->format('D')], [$day->format('d')=>1]);
        }else{
            array_push($days[$day->format('D')], [$day->format('d')=>0]);
        }

        return true;
    }

    private function getWorkingDays(){
        $working_days = [];
        $center_working_days = Center::first(['working_days']);
        if(isset($center_working_days) && $center_working_days!=null){
            $working_days = explode(', ', $center_working_days->working_days);
        }

        return $working_days;
    }

    private function checkAppointmentDay($day, $working_days){
        if( in_array(strtolower($day->format('D')), $working_days) ){
            return true;
        }

        return false;
    }

    public function dayAppointments(Request $request){
        $appointments = [];
        $working_days = $this->getWorkingDays();

        if(isset($request->date) && $request->date!=null){
            $day = Carbon::createFromFormat('Y M d', $request->date)->format('D');
            if( in_array(strtolower($day), $working_days) ){
                $day_date = Carbon::createFromFormat('Y M d', $request->date)->format('Y-m-d');
                $appointments = $this->workHours($day_date);
            }
        }

        return response()->json(['appointments' => $appointments], 200);
    }

    private function workHours($day_date){
        $hours = [];
        $center = Center::first();

        if((isset($center->from) && $center->from!=null) && (isset($center->to) && $center->to!=null)){
            $tStart = strtotime( substr($center->from, 0, strpos($center->from, " ")) );
            $tEnd = strtotime( substr($center->to, 0, strpos($center->to, " ")) );
            $tNow = $tStart;

            while($tNow <= $tEnd){
                $reservation = Reservation::where('date', $day_date)->where('from', date('H:i A',$tNow))->first();
                if($reservation == null){
                    array_push($hours, ["from"=>date('H:i A',$tNow), "status"=>1]);
                }
                $tNow = strtotime('+60 minutes',$tNow);
            }
        }

        return $hours;
    }

    private function formatDate($date){
        return Carbon::createFromFormat('Y M d', $date)->format('Y-m-d');
    }

    public function reserveAppointment(Request $request){
        $Validated = Validator::make($request->all(), [
            'date' => 'required',
            'from' => 'required',
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
        $reservation->fill($request->only('from', 'patient_name', 'phone_number', 'gender', 'age', 'description', 'payment_type'));
        $reservation->date = $this->formatDate($request->date);
        $reservation->to = date('H:i A', (strtotime(substr($request->from, 0, 5)) + (60*60)) );
        if($reservation->save()){

            if($reservation->payment_type == 1){
                $this->saveBankTransfer($request, $reservation->id);
            }

            return response()->json(['message' => 'appointment reserved successfully.'], 200);
        }else{
            return response()->json(['message' => 'an error occurred.'], 200);
        }  
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
                array_push($reservations_array, $this->formatReservation($reservation, app()->getLocale()));
            }
        }

        return response()->json(['reservations' => $reservations_array], 200);
    }

    public function clientCurrentReservation(Request $request){
        $client_id = $request->user()->id;
        $reservations_array = [];

        $reservations = Reservation::where('client_id', $client_id)->get();
        if(isset($reservations) && $reservations!=null){
            foreach($reservations as $reservation){
                if( $this->formatReservationDate($reservation) >= date('Y-m-d')){
                    array_push($reservations_array, $this->formatReservation($reservation, app()->getLocale()));
                }
            }
        }

        return response()->json(['reservations' => $reservations_array], 200);
    }

    public function clientFinishedReservation(Request $request){
        $client_id = $request->user()->id;
        $reservations_array = [];

        $reservations = Reservation::where('client_id', $client_id)->get();
        if(isset($reservations) && $reservations!=null){
            foreach($reservations as $reservation){
                if( $this->formatReservationDate($reservation) < date('Y-m-d')){
                    array_push($reservations_array, $this->formatReservation($reservation, app()->getLocale()));
                }
            }
        }

        return response()->json(['reservations' => $reservations_array], 200);
    }

    public function clientReservationShow($reservation_id, Request $request){
        $client_id = $request->user()->id;
        $reservation_array = [];

        $reservation = Reservation::where('id', $reservation_id)->first();
        if(isset($reservation) && $reservation!=null){
            $reservation_array = $this->formatReservation($reservation, app()->getLocale());
        }

        return response()->json(['reservation' => $reservation_array], 200);
    }

    private function formatReservation($reservation, $lang){
        $reservation_array = [];
        $doctor = Doctor::first();

        if(isset($doctor) && $doctor!=null){
            $reservation_array = [
                'order_id' => '#'.$reservation->id,
                'doctor' => $doctor->getTranslation('name', $lang),
                'doctor_image' => $doctor->image != null ? url($doctor->image) : '',
                'specialty' => $doctor->specialty->getTranslation('title', $lang),
                'subspecialty' => $doctor->getTranslation('subspecialty', $lang),
                'medical_examination_price' => $doctor->medical_examination_price,
                'date' => $reservation->date,
                'from' => $reservation->from,
                'to' => $reservation->to,
            ];
        }

        return $reservation_array;
    }

    public function clientReservationCancel(Request $request){
        $Validated = Validator::make($request->all(), [
            'reservation_id' => 'required',
        ]);

        if($Validated->fails())
            return response()->json($Validated->messages(), 403);

        $reservation = Reservation::where('id', $request->reservation_id)->first();
        if(isset($reservation) && $reservation!=null){
            $reservation->status = 0;
            if($reservation->save()){
                return response()->json(['message' => trans('api.reservation_cancelled_successfully')], 403);
            }
        }

        return response()->json(['message' => trans('api.reservation_not_found')], 403);
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

    private function formatReservationDate($reservation){
        return Carbon::parse($reservation->date)->format('Y-m-d');
    }
}
