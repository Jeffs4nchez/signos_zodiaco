<?php
/**
 * Ejemplos de uso del Cliente Zodiac API
 * Archivo: ejemplos.php
 */

// Incluir el cliente
require_once 'ZodiacAPIClient.php';

// ========== CONFIGURACIÓN ==========
// URL de tu API Zodiac
$API_URL = 'http://192.168.0.9:8000';

// Crear instancia del cliente
$zodiacClient = new ZodiacAPIClient($API_URL);

echo "═══════════════════════════════════════════════════════════\n";
echo "     🔮 ZODIAC API - EJEMPLOS DE USO EN PHP\n";
echo "═══════════════════════════════════════════════════════════\n\n";

// ========== EJEMPLO 1: Obtener Todos los Signos ==========
echo "📍 EJEMPLO 1: Obtener Todos los Signos\n";
echo "───────────────────────────────────────────────────────────\n";

$signos = $zodiacClient->getAllSigns();

if ($signos) {
    echo "Total de signos: " . count($signos) . "\n\n";
    
    foreach ($signos as $signo) {
        echo "  " . $signo['symbol'] . " " . str_pad($signo['name'], 15) . 
             " | " . $signo['element'] . 
             " | " . $signo['date_range'] . "\n";
    }
}

echo "\n";

// ========== EJEMPLO 2: Obtener tu Signo ==========
echo "📍 EJEMPLO 2: Obtener tu Signo por Fecha\n";
echo "───────────────────────────────────────────────────────────\n";

$miSigno = $zodiacClient->getZodiacSign('1990-05-03');

if ($miSigno) {
    echo "Fecha de nacimiento: " . $miSigno['birth_date'] . "\n";
    echo "Tu signo: " . $miSigno['zodiac_sign'] . " " . $miSigno['symbol'] . "\n";
    echo "Edad: " . $miSigno['age'] . " años\n";
    echo "Rango: " . $miSigno['date_range'] . "\n";
    echo "Elemento: " . $miSigno['element'] . "\n";
    echo "Compatible con: " . implode(', ', $miSigno['compatible_signs']) . "\n";
    echo "\nDescripción:\n" . $miSigno['description'] . "\n";
}

echo "\n";

// ========== EJEMPLO 3: Obtener Información de un Signo ==========
echo "📍 EJEMPLO 3: Información Detallada de un Signo\n";
echo "───────────────────────────────────────────────────────────\n";

$tauro = $zodiacClient->getSignByName('Tauro');

if ($tauro) {
    echo "Signo: " . $tauro['name'] . " " . $tauro['symbol'] . "\n";
    echo "Elemento: " . $tauro['element'] . "\n";
    echo "Rango de fechas: " . $tauro['date_range'] . "\n";
    echo "Compatible con: " . implode(', ', $tauro['compatible_signs']) . "\n";
    echo "\nDescripción:\n" . $tauro['description'] . "\n";
}

echo "\n";

// ========== EJEMPLO 4: Verificar Compatibilidad ==========
echo "📍 EJEMPLO 4: Compatibilidad entre Dos Signos\n";
echo "───────────────────────────────────────────────────────────\n";

$compatibility = $zodiacClient->getCompatibility('Tauro', 'Virgo');

if ($compatibility) {
    echo $compatibility['sign1'] . " ↔️ " . $compatibility['sign2'] . "\n";
    echo "¿Compatible? " . ($compatibility['compatible'] ? "✓ SÍ" : "✗ NO") . "\n";
    echo "Mensaje: " . $compatibility['compatibility_message'] . "\n";
}

echo "\n";

// ========== EJEMPLO 5: Aplicación Interactiva ==========
echo "📍 EJEMPLO 5: Búsqueda Interactiva\n";
echo "───────────────────────────────────────────────────────────\n";

// Simulando que el usuario proporciona una fecha
$userBirthDate = '1995-07-14';

echo "Buscando signo para: $userBirthDate\n\n";

$resultado = $zodiacClient->getZodiacSign($userBirthDate);

if ($resultado) {
    $signo = $resultado['zodiac_sign'];
    echo "✨ ¡Hola! Tu signo zodiacal es: $signo " . $resultado['symbol'] . "\n";
    echo "────────────────────────────────────────────────────────\n";
    echo "Descripción:\n" . $resultado['description'] . "\n";
    echo "\nTe llevas bien con: " . implode(', ', $resultado['compatible_signs']) . "\n";
}

echo "\n═══════════════════════════════════════════════════════════\n";
echo "✅ Ejemplos completados\n";
echo "═══════════════════════════════════════════════════════════\n";

?>
