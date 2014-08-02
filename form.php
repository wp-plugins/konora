<?php

$url = $_GET['url'];

$name = $_GET['name'];
$email = $_GET['email'];

$string = $url . '?name=' . $name . '&email=' . $email;

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $string); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);  

// Se tutto e' andato bene marca il record come lavorato
if($httpCode >= 200 or $httpCode < 300) {
    
}

http_response_code(200);

