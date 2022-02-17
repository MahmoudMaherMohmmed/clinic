<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index(Request $request)
    {
        $specialties = $this->formatSpecialties(Specialty::get(), app()->getLocale());

        return response()->json(['specialties' => $specialties]);
    }

    private function formatSpecialties($specialties, $lang){
        $specialties_array = [];

        foreach($specialties as $specialty){
            array_push($specialties_array, [
                'id' => $specialty->id,
                'title' => $specialty->getTranslation('title', $lang),
                'description' => $specialty->getTranslation('description', $lang),
                'image' => isset($specialty->image) && $specialty->image!=null ? url($specialty->image) : '',
                'doctors_count' => $specialty->doctors->count(),
                'doctors' => $this->formatDoctors($specialty, $lang),
            ]);
        }

        return $specialties_array;
    }

    public function specialty($id, Request $request){
        $specialty_data = [];
        $specialty = Specialty::where('id', $id)->first();

        if(isset($specialty) && $specialty!=null){
            $specialty_data = $this->formatSpecialty($specialty, app()->getLocale());
        }

        return response()->json(['specialty' => $specialty_data]);
    }

    private function formatSpecialty($specialty, $lang){
        $specialty_array = [
            'id' => $specialty->id,
            'title' => $specialty->getTranslation('title', $lang),
            'description' => $specialty->getTranslation('description', $lang),
            'image' => isset($specialty->image) && $specialty->image!=null ? url($specialty->image) : '',
            'doctors_count' => $specialty->doctors->count(),
            'doctors' => $this->formatDoctors($specialty, $lang),
        ];

        return $specialty_array;
    }

    private function formatDoctors($specialty, $lang){
        $doctors_array = [];

        $doctors_count = $specialty->doctors->count();

        if($doctors_count > 0){
            $doctors = $specialty->doctors;

            foreach($doctors as $doctor){
                array_push($doctors_array,[
                    'id' => $doctor->id,
                    'name' => $doctor->getTranslation('name', $lang),
                    'subspecialty' => $doctor->getTranslation('subspecialty', $lang),
                    'graduation_university' => $doctor->getTranslation('graduation_university', $lang),
                    'medical_examination_price' => $doctor->medical_examination_price,
                    'image' => isset($doctor->image) && $doctor->image != null ? url($doctor->image) : '',
                ]);
            }
        }

        return $doctors_array;
    }
}
