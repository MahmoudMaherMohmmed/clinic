<?php


namespace App\Http\Services;

use App\Http\Repository\StaticTranslationRepository;
use Illuminate\Support\Arr;

class StaticTranslationService
{
    /**
     * @var StaticTranslationRepository
     */
    private $staticTraslationRepository;

    /**
     * __construct
     *
     * @param  StaticTranslationRepository $staticTraslationRepository
     * @return void
     */
    public function __construct(StaticTranslationRepository $staticTraslationRepository)
    {
        $this->staticTraslationRepository  = $staticTraslationRepository;
    }
    /**
     * handle function that make update for staticTraslation
     * @param array $request
     * @return StaticTranslation
     */
    public function handle($request, $staticTraslationId = null)
    {
        $staticTraslation = $this->staticTraslationRepository;

        if($staticTraslationId) {
            $staticTraslation = $this->staticTraslationRepository->find($staticTraslationId);
        }

        $staticTraslation->fill(Arr::only($request,['key_word']));

        $staticTraslation->save();

        $this->saveLang($request['translations'], $staticTraslation);

    	return $staticTraslation->refresh();
    }

    public function saveLang($translations, $staticTraslation)
    {
        $staticTraslation->languages()->sync([]);

        foreach ($translations as $key => $value) {
            $staticTraslation->languages()->attach($key,['body'=>$value]);
        }

    }

}
