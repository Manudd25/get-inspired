<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://happy-bay-016ec1303.1.azurestaticapps.net");

$quotes = json_decode(file_get_contents("quotes.json"), true);

// pick a random quote
$randomQuote = $quotes[array_rand($quotes)];

echo json_encode($randomQuote);
