<?php

header('Access-Control-Allow-Origin: *');

//ini_set('display_errors','On');
//error_reporting(E_ALL);

$name = array_key_exists('name', $_GET) ? $_GET['name'] : NULL;
$surname = array_key_exists('surname', $_GET) ? $_GET['surname'] : NULL;
$email = array_key_exists('email', $_GET) ? $_GET['email'] : NULL;
$phone = array_key_exists('phone', $_GET) ? $_GET['phone'] : NULL;
$address_city_1 = array_key_exists('city', $_GET) ? $_GET['city'] : NULL;
$note = array_key_exists('note', $_GET) ? $_GET['note'] : NULL;
$sponsor = array_key_exists('sponsor', $_GET) ? $_GET['sponsor'] : NULL;
$birthday_day = array_key_exists('birthday_day', $_GET) ? $_GET['birthday_day'] : NULL;
$street = array_key_exists('address_street_1', $_GET) ? $_GET['address_street_1'] : NULL;
$city = array_key_exists('address_city_1', $_GET) ? $_GET['address_city_1'] : NULL;
$district = array_key_exists('address_district_1', $_GET) ? $_GET['address_district_1'] : NULL;
$postcode = array_key_exists('address_postcode_1', $_GET) ? $_GET['address_postcode_1'] : NULL;
$state = array_key_exists('address_state_1', $_GET) ? $_GET['address_state_1'] : NULL;
$signup = array_key_exists('signup', $_GET) ? $_GET['signup'] : NULL;
$pack = array_key_exists('pack', $_GET) ? $_GET['pack'] : NULL;
$recurrence = array_key_exists('recurrence', $_GET) ? $_GET['recurrence'] : NULL;
$id_circle = array_key_exists('id_circle', $_GET) ? $_GET['id_circle'] : NULL;


$string = 'https://panel.konora.com/api/form/' . $id_circle
        . '?name=' . urlencode($name)
        . '&surname=' . urlencode($surname)
        . '&phone=' . urlencode($phone)
        . '&email=' . urlencode($email)
        . '&birthday_day=' . urlencode($birthday_day)
        . '&address_street_1=' . urlencode($street)
        . '&address_city_1=' . urlencode($city)
        . '&address_district_1=' . urlencode($district)
        . '&address_postcode_1=' . urlencode($postcode)
        . '&address_state_1=' . urlencode($state)
        . '&note=' . urlencode($note)
        . '&sponsor=' . urlencode($sponsor)
        . '&signup=' . urlencode($signup)
        . '&pack=' . urlencode($pack)
        . '&recurrence=' . urlencode($recurrence);

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'user_agent'=> array_key_exists('HTTP_USER_AGENT', $_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : NULL
  )
);

$response = file_get_contents($string, false, stream_context_create($opts));

list($version, $httpCode, $msg) = explode(' ', $http_response_header[0], 3);

setcookie("email", $email, NULL, '/');

require "../../../wp-includes/class-IXR.php";

$rpc = new IXR_Client("http://" . $_SERVER['HTTP_HOST']. "/xmlrpc.php");
$status = $rpc->query(
        "konora.form", // method name
        array($_GET, $_SERVER)
);

/*
if (!$status) {
   print "Error ( " . $rpc->getErrorCode() . " ) : ";
   print $rpc->getErrorMessage() . "\n";
   exit;
}

$rpc->getResponse();
*/

http_response_code($httpCode);