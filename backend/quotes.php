<?php
// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Actual quotes 
header("Content-Type: application/json");
$quotes = json_decode(file_get_contents("quotes.json"), true);
$randomQuote = $quotes[array_rand($quotes)];
echo json_encode($randomQuote);
