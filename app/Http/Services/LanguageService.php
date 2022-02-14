<?php


namespace App\Http\Services;

use App\Http\Repository\LanguageRepository;

class LanguageService
{
    /**
     * @var LanguageRepository
     */
    private $languageRepository;

    /**
     * __construct
     *
     * @param  LanguageRepository $languageRepository
     * @return void
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository  = $languageRepository;
    }
    /**
     * handle function that make update for language
     * @param array $request
     * @return Language
     */
    public function handle($request, $languageId = null)
    {
        $language = $this->languageRepository;

        if($languageId) {
            $language = $this->languageRepository->find($languageId);
        }

        $language->fill($request);

        $language->save();

    	return $language;
    }

}
