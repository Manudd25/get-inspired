<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // allow Vue dev server

$quotes = json_decode(file_get_contents("quotes.json"), true);

// pick a random quote
$randomQuote = $quotes[array_rand($quotes)];

echo json_encode($randomQuote);
