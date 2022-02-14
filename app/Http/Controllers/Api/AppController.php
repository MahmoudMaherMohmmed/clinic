<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Massara;
use App\Models\Term;
use App\Models\Center;
use App\Models\Slider;
use App\Models\HomeSlider;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;

class AppController extends Controller
{

    public function applicationStatus(){
        $application_status = 1; //development mode
        $status = Setting::where('key', 'development_mode')->first();
        if(isset($status) && $status!=null){
            $application_status = $status->value;
        }

        return response()->json(['application_status' => $application_status], 200);
    }

    public function aboutMassara(Request $request){
        $massara = Massara::first();
        $about_massara = [];
        $lang = $request->lang;

        if(isset($massara) && $massara!=null){
            $about_massara = [
                'description' => isset($lang) && $lang!=null ? $massara->getTranslation('description', $lang) : $massara->description,
            ];
        }

        return response()->json(['massara' => $about_massara], 200);
    } 

    public function center(Request $request){
        $center = Center::first();
        $center_info = [];
        $lang = $request->lang;

        if(isset($center) && $center!=null){
            $center_info = [
                'description' => isset($lang) && $lang!=null ? $center->getTranslation('description', $lang) : $center->description,
                'email' => $center->email,
                'contact_email' => $center->contact_email,
                "phone_1" => $center->phone_1,
                "phone_2" => $center->phone_2,
                "facebook_link" => $center->facebook_link,
                "whatsapp_link" => $center->whatsapp_link,
                "instagram_link" => $center->instagram_link,
                "lat" => $center->lat,
                "lng" => $center->lng,
                "logo" => url($center->logo),
            ];
        }

        return response()->json(['center' => $center_info], 200);
    }

    public function TermsAndConditions(Request $request){
        $term = Term::first();
        $terms_and_conditions = [];
        $lang = $request->lang;

        if(isset($term) && $term!=null){
            $terms_and_conditions = [
                'description' => isset($lang) && $lang!=null ? $term->getTranslation('description', $lang) : $term->description,
            ];
        }

        return response()->json(['terms_and_conditions' => $terms_and_conditions], 200);
    }

    public function contactMail(Request $request){
        $Validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($Validated->fails())
            return response()->json($Validated->messages(), 403);

        $center = Center::first();
        if(isset($center) && $center!=null){
            $data = ['name'=>$request->name, 'subject'=>$request->subject, 'message_body'=>$request->message];
            $message = $request->message;
            Mail::send('mail', $data, function($message) use ($center, $request) {
                $message->to($center->contact_email, 'Massara')
                ->subject($request->subject)
                ->from('info@massara.com','Massara Contact Us');
             });
    
             return response()->json(['message' => 'Your Message Sent Successfully.'], 200);
        }else{
            return response()->json(['message' => 'No Contact Mail is configured.'], 403);
        }
        
    }

    public function sliders(Request $request)
    {
        $sliders = $this->formateSliders(Slider::get(), $request->lang);

        return response()->json(['sliders' => $sliders]);
    }

    private function formateSliders($sliders, $lang){
        $sliders_array = [];

        foreach($sliders as $slider){
            array_push($sliders_array, [
                'id' => $slider->id,
                'title' => isset($lang) && $lang!=null ? $slider->getTranslation('title', $lang) : $slider->title,
                'description' => isset($lang) && $lang!=null ? $slider->getTranslation('description', $lang) : $slider->description,
                'image' => url($slider->image)
            ]);
        }

        return $sliders_array;
    }

    public function homeSliders(Request $request)
    {
        $home_sliders = $this->formateHomeSliders(HomeSlider::get(), $request->lang);

        return response()->json(['home_sliders' => $home_sliders]);
    }

    private function formateHomeSliders($home_sliders, $lang){
        $home_sliders_array = [];

        foreach($home_sliders as $home_slider){
            array_push($home_sliders_array, [
                'id' => $home_slider->id,
                'title' => isset($lang) && $lang!=null ? $home_slider->getTranslation('title', $lang) : $home_slider->title,
                'image' => url($home_slider->image)
            ]);
        }

        return $home_sliders_array;
    }

    public function search($key, Request $request){
        $doctors = [];

        $specialties = Specialty::join('translatables', 'translatables.record_id','=', 'specialties.id')
                        ->join('tans_bodies', 'tans_bodies.translatable_id', '=', 'translatables.id')
                        ->where('translatables.table_name', 'specialties')
                        ->where('tans_bodies.body', 'Like', '%'.$key.'%')
                        ->orWhere('specialties.title', 'Like', '%'.$key.'%')
                        ->groupBy(['specialties.id'])
                        ->get(['specialties.id']);

        if(isset($specialties) && $specialties!=null && count($specialties)>0){
            foreach($specialties as $specialty){
                $doctors = $this->formatDoctors($specialty->doctors, $request->lang);
            }
        }else{
            $doctors = Doctor::join('translatables', 'translatables.record_id','=', 'doctors.id')
                        ->join('tans_bodies', 'tans_bodies.translatable_id', '=', 'translatables.id')
                        ->where('translatables.table_name', 'doctors')
                        ->where('tans_bodies.body', 'Like', '%'.$key.'%')
                        ->orWhere('doctors.name', 'Like', '%'.$key.'%')
                        ->groupBy(['doctors.id'])
                        ->get(['doctors.id']);

            if(isset($doctors) && $doctors!=null && count($doctors)>0){
                foreach($doctors as $doctor_id){
                    $doctors = $this->formatDoctors(Doctor::find($doctor_id), $request->lang);
                }
            }
        }

        
        return response()->json(['doctors' => $doctors]);
    }

    private function formatDoctors($doctors, $lang){
        $doctors_array = [];

        foreach($doctors as $doctor){
            array_push($doctors_array,[
                'id' => $doctor->id,
                'name' => isset($lang) && $lang!=null ? $doctor->getTranslation('name', $lang) : $doctor->name,
                'subspecialty' => isset($lang) && $lang!=null ? $doctor->getTranslation('subspecialty', $lang) : $doctor->subspecialty,
                'graduation_university' => isset($lang) && $lang!=null ? $doctor->getTranslation('graduation_university', $lang) : $doctor->graduation_university,
                'medical_examination_price' => $doctor->medical_examination_price,
                'image' => url($doctor->image),
            ]);
        }

        return $doctors_array;
    }
    
}
