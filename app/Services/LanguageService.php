<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LanguageService
{
    protected $apiUrl = 'https://libretranslate.com/translate';

    public function detectLanguage($text)
    {
        // Ensure the text is not empty
        if (empty($text)) {
            return null;
        }

        // Make a POST request to the LibreTranslate API
        $response = Http::post($this->apiUrl, [
            'q' => $text
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Extract and return the detected language code
            return $response->json()[0]['language'] ?? 'unknown';
        }

        // Handle errors or unsuccessful responses
        return 'Error detecting language';
    }


}
