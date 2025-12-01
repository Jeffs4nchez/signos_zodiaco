<?php

// 🔮 ZODIAC SIGN API - SIMPLE VERSION FOR RAILWAY
// Versión simplificada sin necesidad de toda la configuración de Laravel

require_once __DIR__ . '/../vendor/autoload.php';

// Datos de los signos zodiacales
$zodiacSigns = [
    ['name' => 'Capricornio', 'start_month' => 12, 'start_day' => 22, 'end_month' => 1, 'end_day' => 19],
    ['name' => 'Acuario', 'start_month' => 1, 'start_day' => 20, 'end_month' => 2, 'end_day' => 18],
    ['name' => 'Piscis', 'start_month' => 2, 'start_day' => 19, 'end_month' => 3, 'end_day' => 20],
    ['name' => 'Aries', 'start_month' => 3, 'start_day' => 21, 'end_month' => 4, 'end_day' => 19],
    ['name' => 'Tauro', 'start_month' => 4, 'start_day' => 20, 'end_month' => 5, 'end_day' => 20],
    ['name' => 'Géminis', 'start_month' => 5, 'start_day' => 21, 'end_month' => 6, 'end_day' => 20],
    ['name' => 'Cáncer', 'start_month' => 6, 'start_day' => 21, 'end_month' => 7, 'end_day' => 22],
    ['name' => 'Leo', 'start_month' => 7, 'start_day' => 23, 'end_month' => 8, 'end_day' => 22],
    ['name' => 'Virgo', 'start_month' => 8, 'start_day' => 23, 'end_month' => 9, 'end_day' => 22],
    ['name' => 'Libra', 'start_month' => 9, 'start_day' => 23, 'end_month' => 10, 'end_day' => 22],
    ['name' => 'Escorpio', 'start_month' => 10, 'start_day' => 23, 'end_month' => 11, 'end_day' => 21],
    ['name' => 'Sagitario', 'start_month' => 11, 'start_day' => 22, 'end_month' => 12, 'end_day' => 21],
];

// Función para obtener signo
function getZodiacSign($birthDate) {
    global $zodiacSigns;
    
    try {
        $date = new DateTime($birthDate);
        $month = (int)$date->format('m');
        $day = (int)$date->format('d');
        
        foreach ($zodiacSigns as $sign) {
            if ($sign['start_month'] == $sign['end_month']) {
                if ($month == $sign['start_month'] && $day >= $sign['start_day'] && $day <= $sign['end_day']) {
                    return $sign['name'];
                }
            } else {
                if (($month == $sign['start_month'] && $day >= $sign['start_day']) ||
                    ($month == $sign['end_month'] && $day <= $sign['end_day'])) {
                    return $sign['name'];
                }
            }
        }
    } catch (Exception $e) {
        return null;
    }
    
    return null;
}

// Routing simple
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// API Endpoints
if ($path === '/api/zodiac' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $sign = getZodiacSign($input['birth_date'] ?? null);
    echo json_encode([
        'success' => $sign !== null,
        'birth_date' => $input['birth_date'] ?? null,
        'zodiac_sign' => $sign
    ]);
    exit;
}

if ($path === '/api/zodiac/signs' && $method === 'GET') {
    echo json_encode([
        'success' => true,
        'count' => count($zodiacSigns),
        'signs' => array_column($zodiacSigns, 'name')
    ]);
    exit;
}

if ($path === '/health' || $path === '/up') {
    http_response_code(200);
    echo json_encode(['status' => 'ok']);
    exit;
}

// Default response
if ($path === '/') {
    http_response_code(200);
    echo json_encode([
        'name' => 'Zodiac Sign API',
        'version' => '1.0',
        'status' => 'online',
        'endpoints' => [
            'POST /api/zodiac' => 'Get zodiac sign from birth date',
            'GET /api/zodiac/signs' => 'List all zodiac signs',
            'GET /health' => 'Health check'
        ]
    ]);
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Not found']);
