<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Massara;
use App\Models\Term;
use App\Models\Center;
use App\Models\Slider;
use App\Models\HomeSlider;
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

    public function aboutClinic(Request $request){
        $massara = Massara::first();
        $about_massara = [];

        if(isset($massara) && $massara!=null){
            $about_massara = [
                'description' => $massara->getTranslation('description', app()->getLocale()),
            ];
        }

        return response()->json(['massara' => $about_massara], 200);
    } 

    public function center(Request $request){
        $center = Center::first();
        $center_info = [];

        if(isset($center) && $center!=null){
            $center_info = [
                'description' => $center->getTranslation('description', app()->getLocale()),
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

        if(isset($term) && $term!=null){
            $terms_and_conditions = [
                'description' => $term->getTranslation('description', app()->getLocale()),
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
                $message->to($center->contact_email, 'Clinic')
                ->subject($request->subject)
                ->from('info@clinic.com','Clinic Contact Us');
             });
    
             return response()->json(['message' => 'Your Message Sent Successfully.'], 200);
        }else{
            return response()->json(['message' => 'No Contact Mail is configured.'], 403);
        }
        
    }

    public function sliders(Request $request)
    {
        $sliders = $this->formateSliders(Slider::get(), app()->getLocale());

        return response()->json(['sliders' => $sliders]);
    }

    private function formateSliders($sliders, $lang){
        $sliders_array = [];

        foreach($sliders as $slider){
            array_push($sliders_array, [
                'id' => $slider->id,
                'title' => $slider->getTranslation('title', $lang),
                'description' => $slider->getTranslation('description', $lang),
                'image' => url($slider->image)
            ]);
        }

        return $sliders_array;
    }

    public function homeSliders(Request $request)
    {
        $home_sliders = $this->formateHomeSliders(HomeSlider::get(), app()->getLocale());

        return response()->json(['home_sliders' => $home_sliders]);
    }

    private function formateHomeSliders($home_sliders, $lang){
        $home_sliders_array = [];

        foreach($home_sliders as $home_slider){
            array_push($home_sliders_array, [
                'id' => $home_slider->id,
                'title' => $home_slider->getTranslation('title', $lang),
                'image' => url($home_slider->image)
            ]);
        }

        return $home_sliders_array;
    }
    
}
