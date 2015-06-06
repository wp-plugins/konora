<?php

include '../../../wp-load.php';

$name = $_GET['name'];
$surname = $_GET['surname'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$address_city_1 = $_GET['city'];
$note = $_GET['note'];
$sponsor = $_GET['sponsor'];
$birthday_day = $_GET['birthday_day'];
$street = $_GET['address_street_1'];
$city = $_GET['address_city_1'];
$district = $_GET['address_district_1'];
$postcode = $_GET['address_postcode_1'];
$state = $_GET['address_state_1'];
$signup = $_GET['signup'];
$pack = $_GET['pack'];
$recurrence = $_GET['recurrence'];
$id_circle = $_GET['id_circle'];
                    

$string = 'http://panel.konora.com/api/form/' . $id_circle
    . '?name=' . $name 
    . '&surname=' . $surname 
    . '&phone=' . $phone 
    . '&email=' . $email 
    . '&birthday_day=' . $birthday_day 
    . '&address_street_1=' . $street
    . '&address_city_1=' . $city
    . '&address_district_1=' . $district
    . '&address_postcode_1=' . $postcode
    . '&address_state_1=' . $state
    . '&note=' . $note 
    . '&sponsor=' . $sponsor
    . '&signup=' . $signup 
    . '&pack=' . $pack 
    . '&recurrence=' . $recurrence;

$response = file_get_contents($string);

list($version,$httpCode,$msg) = explode(' ',$http_response_header[0], 3);

http_response_code($httpCode);

$string = 'http://panel.konora.com/api/form_stats?circle_id=' . $id_circle . '&compiled=1';
file_get_contents($string);

setcookie("email", $email, NULL, '/', '.' . cookie_domain());

global $wpdb;

$table_name = $wpdb->prefix . "konora_form";
$rows_affected = $wpdb->insert( $table_name, array( 
                                    'ip' => $_SERVER['REMOTE_ADDR'], 
                                    'user_agent' => $_SERVER['HTTP_USER_AGENT'], 
                                    'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                                    'param' => serialize($_GET)) 
                              );