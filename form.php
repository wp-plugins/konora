<?php

$url = $_GET['url'];
$name = $_GET['name'];
$surname = $_GET['surname'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$address_city_1 = $_GET['city'];
$note = $_GET['note'];
$sponsor = $_GET['sponsor'];
$birthday_day = $_GET['birthday'];

$string = $url . '?name=' . $name . '&surname=' . $surname . '&phone=' . $phone . '&email=' . $email . '&birthday_day=' . $birthday_day . '&address_city_1=' . $address_city_1 . '&note=' . $note . '&sponsor=' . $sponsor;

$response = file_get_contents($string);

list($version,$httpCode,$msg) = explode(' ',$http_response_header[0], 3);

http_response_code($httpCode);

$string = 'https://www.konora.com/api/form_stats?circle_id=' . $name . '&compiled=1';
file_get_contents($string);
