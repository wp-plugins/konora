<?php

$url = $_GET['url'];
$name = $_GET['name'];
$email = $_GET['email'];
$sponsor = $_GET['sponsor'];

$string = $url . '?name=' . $name . '&email=' . $email . '&sponsor=' . $sponsor;

$response = file_get_contents($string);

/*
 * Questo e' la variante per usare le librerie curl

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);

  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);

 * 
 */

list($version,$httpCode,$msg) = explode(' ',$http_response_header[0], 3);

http_response_code($httpCode);