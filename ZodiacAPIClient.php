<?php
/**
 * Cliente para consumir Zodiac API
 * Archivo: ZodiacAPIClient.php
 */

class ZodiacAPIClient {
    private $baseURL;
    private $apiURL;
    
    /**
     * Constructor
     * @param string $baseURL URL base del servidor (ej: http://192.168.0.9:8000)
     */
    public function __construct($baseURL = 'http://192.168.0.9:8000') {
        $this->baseURL = $baseURL;
        $this->apiURL = $baseURL . '/api';
    }
    
    /**
     * Obtener todos los signos zodiacales
     * @return array|null Array con los signos o null si hay error
     */
    public function getAllSigns() {
        echo "📌 Obteniendo todos los signos...\n";
        
        try {
            $url = $this->apiURL . '/zodiac/signs';
            $response = file_get_contents($url);
            
            if ($response === false) {
                echo "❌ Error: No se pudo conectar a la API\n";
                return null;
            }
            
            $data = json_decode($response, true);
            
            if ($data['success']) {
                echo "✅ Se obtuvieron " . $data['data']['count'] . " signos\n";
                return $data['data']['signs'];
            } else {
                echo "❌ Error: " . $data['message'] . "\n";
                return null;
            }
        } catch (Exception $e) {
            echo "❌ Excepción: " . $e->getMessage() . "\n";
            return null;
        }
    }
    
    /**
     * Obtener signo zodiacal por fecha de nacimiento
     * @param string $birthDate Fecha en formato 'YYYY-MM-DD' o 'DD/MM/YYYY'
     * @return array|null Datos del signo o null si hay error
     */
    public function getZodiacSign($birthDate) {
        echo "📌 Buscando signo para: $birthDate\n";
        
        try {
            $url = $this->apiURL . '/zodiac';
            
            $payload = json_encode(['birth_date' => $birthDate]);
            
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => $payload
                ]
            ];
            
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                echo "❌ Error: No se pudo conectar a la API\n";
                return null;
            }
            
            $data = json_decode($response, true);
            
            if ($data['success']) {
                $signo = $data['data']['zodiac_sign'];
                $symbol = $data['data']['symbol'];
                echo "✅ Tu signo es: $signo $symbol\n";
                return $data['data'];
            } else {
                echo "❌ Error: " . $data['message'] . "\n";
                return null;
            }
        } catch (Exception $e) {
            echo "❌ Excepción: " . $e->getMessage() . "\n";
            return null;
        }
    }
    
    /**
     * Obtener información de un signo específico por nombre
     * @param string $name Nombre del signo (ej: 'Tauro')
     * @return array|null Datos del signo o null si hay error
     */
    public function getSignByName($name) {
        echo "📌 Buscando información de: $name\n";
        
        try {
            $url = $this->apiURL . '/zodiac/signs/' . urlencode($name);
            $response = file_get_contents($url);
            
            if ($response === false) {
                echo "❌ Error: No se pudo conectar a la API\n";
                return null;
            }
            
            $data = json_decode($response, true);
            
            if ($data['success']) {
                echo "✅ Información de $name obtenida\n";
                return $data['data'];
            } else {
                echo "❌ Error: " . $data['message'] . "\n";
                return null;
            }
        } catch (Exception $e) {
            echo "❌ Excepción: " . $e->getMessage() . "\n";
            return null;
        }
    }
    
    /**
     * Obtener compatibilidad entre dos signos
     * @param string $sign1 Primer signo
     * @param string $sign2 Segundo signo
     * @return array|null Datos de compatibilidad o null si hay error
     */
    public function getCompatibility($sign1, $sign2) {
        echo "📌 Verificando compatibilidad: $sign1 ↔️ $sign2\n";
        
        try {
            $url = $this->apiURL . '/zodiac/compatibility';
            
            $payload = json_encode([
                'sign1' => $sign1,
                'sign2' => $sign2
            ]);
            
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => $payload
                ]
            ];
            
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                echo "❌ Error: No se pudo conectar a la API\n";
                return null;
            }
            
            $data = json_decode($response, true);
            
            if ($data['success']) {
                $compatible = $data['data']['compatible'] ? '✓ Sí' : '✗ No';
                echo "✅ Compatible: $compatible\n";
                return $data['data'];
            } else {
                echo "❌ Error: " . $data['message'] . "\n";
                return null;
            }
        } catch (Exception $e) {
            echo "❌ Excepción: " . $e->getMessage() . "\n";
            return null;
        }
    }
}

?>
