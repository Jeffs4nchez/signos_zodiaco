<?php

/**
 * ARCHIVO DE PRUEBA - Zodiac Sign API
 * 
 * Este archivo contiene ejemplos de cómo usar el servicio de signos zodiacales
 * Copia y pega estos códigos en tus proyectos para integrar la funcionalidad
 */

// ============================================
// EJEMPLO 1: OBTENER SIGNO POR FECHA DE NACIMIENTO
// ============================================

/*
Endpoint: POST /api/zodiac
*/

$birth_date = "1995-05-20";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8000/api/zodiac",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(array("birth_date" => $birth_date)),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error: " . $err;
} else {
    echo "Resultado:\n";
    echo $response;
}

// ============================================
// EJEMPLO 2: OBTENER TODOS LOS SIGNOS ZODIACALES
// ============================================

/*
Endpoint: GET /api/zodiac/signs
*/

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8000/api/zodiac/signs",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error: " . $err;
} else {
    echo "Resultado:\n";
    echo $response;
}

// ============================================
// EJEMPLO 3: OBTENER UN SIGNO ESPECÍFICO
// ============================================

/*
Endpoint: GET /api/zodiac/signs/{sign}
*/

$sign = "Tauro";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8000/api/zodiac/signs/" . $sign,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error: " . $err;
} else {
    echo "Resultado:\n";
    echo $response;
}

// ============================================
// EJEMPLO 4: VERIFICAR COMPATIBILIDAD
// ============================================

/*
Endpoint: POST /api/zodiac/compatibility
*/

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost:8000/api/zodiac/compatibility",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(array(
        "sign1" => "Tauro",
        "sign2" => "Virgo"
    )),
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "Error: " . $err;
} else {
    echo "Resultado:\n";
    echo $response;
}

?>
