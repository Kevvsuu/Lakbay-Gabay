<?php
header('Content-Type: application/json');
// MyMemory Translation API endpoint
$api_url = 'https://api.mymemory.translated.net/get';

// Get parameters from the request
$text = $_GET['text'] ?? '';
$target_lang = $_GET['target_lang'] ?? 'en';

// If text is empty or same as target language, return original text
if (empty($text) || $target_lang === 'en') {
    echo json_encode(['responseData' => ['translatedText' => $text]]);
    exit;
}

// Prepare API request URL
$request_url = $api_url . '?q=' . urlencode($text) . '&langpair=en|' . $target_lang;

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $request_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For testing only, remove in production

// Execute the request
$response = curl_exec($ch);
curl_close($ch);

// If API request fails, return original text
if ($response === false) {
    echo json_encode(['responseData' => ['translatedText' => $text]]);
    exit;
}

// Parse the response
$responseData = json_decode($response, true);

// Fix newline handling in the translated text
if (isset($responseData['responseData']['translatedText'])) {
    // Replace literal "\n" with actual newlines
    $translatedText = str_replace('\\n', "\n", $responseData['responseData']['translatedText']);
    $responseData['responseData']['translatedText'] = $translatedText;
    
    // Re-encode with the fixed translation
    echo json_encode($responseData);
} else {
    // Return the original API response if structure is unexpected
    echo $response;
}
?>