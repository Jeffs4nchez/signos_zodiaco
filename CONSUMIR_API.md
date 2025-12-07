# 🔌 Cómo Consumir la Zodiac API - Guía Práctica

## 📌 Conceptos Básicos

**Consumir una API** significa: hacer peticiones a tu servidor y usar los datos que retorna.

```
Tu App (Cliente)
    ↓ Hace petición
Zodiac API (Servidor)
    ↓ Responde con JSON
Tu App usa los datos
```

---

## 🌐 Opción 1: Desde HTML/JavaScript Puro

### Archivo: `index.html`

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consumir Zodiac API</title>
    <style>
        body {
            font-family: Arial;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        input, button {
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        #resultado {
            background: #f0f0f0;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <h1>🔮 Descubre tu Signo Zodiacal</h1>
    
    <div>
        <label>Fecha de nacimiento:</label>
        <input type="date" id="fecha" required>
        <button onclick="obtenerSigno()">Buscar Mi Signo</button>
    </div>
    
    <div id="resultado"></div>
    
    <script>
        // URL de tu API
        const API_URL = 'http://192.168.0.9:8000/api';
        
        // Función para obtener signo por fecha
        async function obtenerSigno() {
            const fecha = document.getElementById('fecha').value;
            
            if (!fecha) {
                alert('Por favor ingresa una fecha');
                return;
            }
            
            try {
                // Hacer petición POST a la API
                const response = await fetch(`${API_URL}/zodiac`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ birth_date: fecha })
                });
                
                // Convertir respuesta a JSON
                const data = await response.json();
                
                // Verificar si fue exitoso
                if (data.success) {
                    const signo = data.data;
                    
                    // Mostrar resultado
                    document.getElementById('resultado').innerHTML = `
                        <h2>${signo.zodiac_sign} ${signo.symbol}</h2>
                        <p><strong>Rango:</strong> ${signo.date_range}</p>
                        <p><strong>Elemento:</strong> ${signo.element}</p>
                        <p><strong>Edad:</strong> ${signo.age} años</p>
                        <p><strong>Descripción:</strong> ${signo.description}</p>
                        <p><strong>Compatible con:</strong> ${signo.compatible_signs.join(', ')}</p>
                    `;
                    document.getElementById('resultado').style.display = 'block';
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                alert('Error al conectar con la API: ' + error.message);
            }
        }
        
        // Función para obtener todos los signos
        async function obtenerTodosLosSignos() {
            try {
                const response = await fetch(`${API_URL}/zodiac/signs`);
                const data = await response.json();
                
                if (data.success) {
                    const signos = data.data.signs;
                    console.log('Total de signos:', signos.length);
                    signos.forEach(signo => {
                        console.log(`${signo.name} (${signo.symbol})`);
                    });
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>
</html>
```

**Cómo usar:**
1. Guarda como `index.html`
2. Abre en navegador
3. Selecciona fecha
4. Click "Buscar Mi Signo"
5. ¡Ves tu signo!

---

## 🚀 Opción 2: Desde JavaScript (Fetch API)

### Archivo: `zodiac-client.js`

```javascript
class ZodiacClient {
    constructor(baseURL = 'http://192.168.0.9:8000') {
        this.baseURL = baseURL;
        this.apiURL = `${baseURL}/api`;
    }
    
    /**
     * Obtener todos los signos zodiacales
     */
    async getAllSigns() {
        console.log('📌 Obteniendo todos los signos...');
        
        try {
            const response = await fetch(`${this.apiURL}/zodiac/signs`);
            const data = await response.json();
            
            if (data.success) {
                console.log(`✅ Se obtuvieron ${data.data.count} signos`);
                return data.data.signs;
            } else {
                console.error('❌ Error:', data.message);
                return null;
            }
        } catch (error) {
            console.error('❌ Error de conexión:', error);
            return null;
        }
    }
    
    /**
     * Obtener signo por fecha de nacimiento
     */
    async getZodiacSign(birthDate) {
        console.log(`📌 Buscando signo para: ${birthDate}`);
        
        try {
            const response = await fetch(`${this.apiURL}/zodiac`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ birth_date: birthDate })
            });
            
            const data = await response.json();
            
            if (data.success) {
                console.log(`✅ Tu signo es: ${data.data.zodiac_sign} ${data.data.symbol}`);
                return data.data;
            } else {
                console.error('❌ Error:', data.message);
                return null;
            }
        } catch (error) {
            console.error('❌ Error:', error);
            return null;
        }
    }
    
    /**
     * Obtener información de un signo específico
     */
    async getSignByName(name) {
        console.log(`📌 Buscando información de: ${name}`);
        
        try {
            const response = await fetch(`${this.apiURL}/zodiac/signs/${name}`);
            const data = await response.json();
            
            if (data.success) {
                console.log(`✅ Información de ${name} obtenida`);
                return data.data;
            } else {
                console.error('❌ Error:', data.message);
                return null;
            }
        } catch (error) {
            console.error('❌ Error:', error);
            return null;
        }
    }
    
    /**
     * Obtener compatibilidad entre dos signos
     */
    async getCompatibility(sign1, sign2) {
        console.log(`📌 Verificando compatibilidad: ${sign1} ↔️ ${sign2}`);
        
        try {
            const response = await fetch(`${this.apiURL}/zodiac/compatibility`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ sign1, sign2 })
            });
            
            const data = await response.json();
            
            if (data.success) {
                console.log(`✅ Compatible: ${data.data.compatible ? '✓' : '✗'}`);
                return data.data;
            } else {
                console.error('❌ Error:', data.message);
                return null;
            }
        } catch (error) {
            console.error('❌ Error:', error);
            return null;
        }
    }
}

// ========== EJEMPLOS DE USO ==========

// Crear instancia del cliente
const zodiac = new ZodiacClient('http://192.168.0.9:8000');

// Ejemplo 1: Obtener todos los signos
async function ejemplo1() {
    console.log('\n=== EJEMPLO 1: Todos los signos ===');
    const signos = await zodiac.getAllSigns();
    if (signos) {
        signos.forEach(s => {
            console.log(`${s.name} (${s.symbol}) - ${s.element}`);
        });
    }
}

// Ejemplo 2: Obtener mi signo
async function ejemplo2() {
    console.log('\n=== EJEMPLO 2: Mi signo ===');
    const miSigno = await zodiac.getZodiacSign('1990-05-03');
    if (miSigno) {
        console.log(`Tu signo: ${miSigno.zodiac_sign}`);
        console.log(`Descripción: ${miSigno.description}`);
    }
}

// Ejemplo 3: Información de un signo
async function ejemplo3() {
    console.log('\n=== EJEMPLO 3: Info de Tauro ===');
    const tauro = await zodiac.getSignByName('Tauro');
    if (tauro) {
        console.log(`Elemento: ${tauro.element}`);
        console.log(`Compatible con: ${tauro.compatible_signs.join(', ')}`);
    }
}

// Ejemplo 4: Compatibilidad
async function ejemplo4() {
    console.log('\n=== EJEMPLO 4: Compatibilidad ===');
    const compatibility = await zodiac.getCompatibility('Tauro', 'Virgo');
    if (compatibility) {
        console.log(`Mensaje: ${compatibility.compatibility_message}`);
    }
}

// Ejecutar todos los ejemplos
async function runAll() {
    await ejemplo1();
    await ejemplo2();
    await ejemplo3();
    await ejemplo4();
}

// En la consola del navegador, ejecuta:
// runAll();
```

**Cómo usar en HTML:**
```html
<script src="zodiac-client.js"></script>
<script>
    const zodiac = new ZodiacClient('http://192.168.0.9:8000');
    
    // Usar el cliente
    zodiac.getZodiacSign('1990-05-03').then(signo => {
        console.log(signo);
    });
</script>
```

---

## 🐍 Opción 3: Desde Python

### Archivo: `zodiac_api.py`

```python
import requests
import json

class ZodiacAPI:
    def __init__(self, base_url='http://192.168.0.9:8000'):
        self.base_url = base_url
        self.api_url = f'{base_url}/api'
    
    def get_all_signs(self):
        """Obtener todos los signos"""
        print('📌 Obteniendo todos los signos...')
        
        try:
            response = requests.get(f'{self.api_url}/zodiac/signs')
            data = response.json()
            
            if data['success']:
                print(f"✅ Se obtuvieron {data['data']['count']} signos")
                return data['data']['signs']
            else:
                print(f"❌ Error: {data['message']}")
                return None
        except Exception as e:
            print(f"❌ Error: {e}")
            return None
    
    def get_zodiac_sign(self, birth_date):
        """Obtener signo por fecha"""
        print(f'📌 Buscando signo para: {birth_date}')
        
        try:
            response = requests.post(
                f'{self.api_url}/zodiac',
                json={'birth_date': birth_date}
            )
            data = response.json()
            
            if data['success']:
                signo = data['data']['zodiac_sign']
                symbol = data['data']['symbol']
                print(f"✅ Tu signo es: {signo} {symbol}")
                return data['data']
            else:
                print(f"❌ Error: {data['message']}")
                return None
        except Exception as e:
            print(f"❌ Error: {e}")
            return None
    
    def get_sign_by_name(self, name):
        """Obtener signo por nombre"""
        print(f'📌 Buscando información de: {name}')
        
        try:
            response = requests.get(f'{self.api_url}/zodiac/signs/{name}')
            data = response.json()
            
            if data['success']:
                print(f"✅ Información de {name} obtenida")
                return data['data']
            else:
                print(f"❌ Error: {data['message']}")
                return None
        except Exception as e:
            print(f"❌ Error: {e}")
            return None
    
    def get_compatibility(self, sign1, sign2):
        """Obtener compatibilidad"""
        print(f'📌 Verificando compatibilidad: {sign1} ↔️ {sign2}')
        
        try:
            response = requests.post(
                f'{self.api_url}/zodiac/compatibility',
                json={'sign1': sign1, 'sign2': sign2}
            )
            data = response.json()
            
            if data['success']:
                compatible = data['data']['compatible']
                print(f"✅ Compatible: {'✓' if compatible else '✗'}")
                return data['data']
            else:
                print(f"❌ Error: {data['message']}")
                return None
        except Exception as e:
            print(f"❌ Error: {e}")
            return None

# ========== EJEMPLOS DE USO ==========

if __name__ == '__main__':
    # Crear instancia
    zodiac = ZodiacAPI('http://192.168.0.9:8000')
    
    print('\n=== EJEMPLO 1: Todos los signos ===')
    signos = zodiac.get_all_signs()
    if signos:
        for s in signos:
            print(f"{s['name']} ({s['symbol']}) - {s['element']}")
    
    print('\n=== EJEMPLO 2: Mi signo ===')
    mi_signo = zodiac.get_zodiac_sign('1990-05-03')
    if mi_signo:
        print(f"Signo: {mi_signo['zodiac_sign']}")
        print(f"Edad: {mi_signo['age']} años")
    
    print('\n=== EJEMPLO 3: Info de Tauro ===')
    tauro = zodiac.get_sign_by_name('Tauro')
    if tauro:
        print(f"Elemento: {tauro['element']}")
        print(f"Compatible: {', '.join(tauro['compatible_signs'])}")
    
    print('\n=== EJEMPLO 4: Compatibilidad ===')
    compatibility = zodiac.get_compatibility('Tauro', 'Virgo')
    if compatibility:
        print(f"Mensaje: {compatibility['compatibility_message']}")
```

**Cómo usar:**
```bash
python zodiac_api.py
```

---

## 🔴 Opción 4: Desde PHP

### Archivo: `zodiac_client.php`

```php
<?php

class ZodiacClient {
    private $baseURL;
    
    public function __construct($baseURL = 'http://192.168.0.9:8000') {
        $this->baseURL = $baseURL;
    }
    
    /**
     * Obtener todos los signos
     */
    public function getAllSigns() {
        echo "📌 Obteniendo todos los signos...\n";
        
        $url = $this->baseURL . '/api/zodiac/signs';
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if ($data['success']) {
            echo "✅ Se obtuvieron " . $data['data']['count'] . " signos\n";
            return $data['data']['signs'];
        } else {
            echo "❌ Error: " . $data['message'] . "\n";
            return null;
        }
    }
    
    /**
     * Obtener signo por fecha
     */
    public function getZodiacSign($birthDate) {
        echo "📌 Buscando signo para: $birthDate\n";
        
        $url = $this->baseURL . '/api/zodiac';
        
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode(['birth_date' => $birthDate])
            ]
        ];
        
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);
        
        if ($data['success']) {
            $signo = $data['data']['zodiac_sign'];
            echo "✅ Tu signo es: $signo\n";
            return $data['data'];
        } else {
            echo "❌ Error: " . $data['message'] . "\n";
            return null;
        }
    }
    
    /**
     * Obtener signo por nombre
     */
    public function getSignByName($name) {
        echo "📌 Buscando información de: $name\n";
        
        $url = $this->baseURL . '/api/zodiac/signs/' . urlencode($name);
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if ($data['success']) {
            echo "✅ Información de $name obtenida\n";
            return $data['data'];
        } else {
            echo "❌ Error: " . $data['message'] . "\n";
            return null;
        }
    }
    
    /**
     * Obtener compatibilidad
     */
    public function getCompatibility($sign1, $sign2) {
        echo "📌 Verificando compatibilidad: $sign1 ↔️ $sign2\n";
        
        $url = $this->baseURL . '/api/zodiac/compatibility';
        
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode([
                    'sign1' => $sign1,
                    'sign2' => $sign2
                ])
            ]
        ];
        
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);
        
        if ($data['success']) {
            $compatible = $data['data']['compatible'] ? '✓' : '✗';
            echo "✅ Compatible: $compatible\n";
            return $data['data'];
        } else {
            echo "❌ Error: " . $data['message'] . "\n";
            return null;
        }
    }
}

// ========== EJEMPLOS DE USO ==========

$client = new ZodiacClient('http://192.168.0.9:8000');

echo "\n=== EJEMPLO 1: Todos los signos ===\n";
$signos = $client->getAllSigns();
if ($signos) {
    foreach ($signos as $s) {
        echo $s['name'] . " (" . $s['symbol'] . ") - " . $s['element'] . "\n";
    }
}

echo "\n=== EJEMPLO 2: Mi signo ===\n";
$miSigno = $client->getZodiacSign('1990-05-03');
if ($miSigno) {
    echo "Signo: " . $miSigno['zodiac_sign'] . "\n";
    echo "Edad: " . $miSigno['age'] . " años\n";
}

echo "\n=== EJEMPLO 3: Info de Tauro ===\n";
$tauro = $client->getSignByName('Tauro');
if ($tauro) {
    echo "Elemento: " . $tauro['element'] . "\n";
    echo "Compatible: " . implode(', ', $tauro['compatible_signs']) . "\n";
}

echo "\n=== EJEMPLO 4: Compatibilidad ===\n";
$compatibility = $client->getCompatibility('Tauro', 'Virgo');
if ($compatibility) {
    echo "Mensaje: " . $compatibility['compatibility_message'] . "\n";
}
?>
```

**Cómo usar:**
```bash
php zodiac_client.php
```

---

## 📊 Resumen: ¿Cuál Usar?

| Tecnología | Caso de Uso | Dificultad |
|-----------|-----------|-----------|
| **HTML/JavaScript** | Página web simple | Fácil ✓ |
| **JavaScript (Node)** | Aplicación web moderna | Media |
| **Python** | Scripts, análisis de datos | Fácil ✓ |
| **PHP** | Integración con backend | Media |
| **Postman** | Pruebas rápidas | Muy fácil ✓ |

---

## 🎯 Paso a Paso: Consume tu API

### Paso 1: Identifica tu caso de uso
¿Dónde quieres usar la API?
- ¿En una página web? → HTML/JavaScript
- ¿En una app Python? → Python
- ¿En un proyecto PHP? → PHP

### Paso 2: Copia el código
Copia el código apropiado del archivo correspondiente

### Paso 3: Reemplaza la URL
Cambia `http://192.168.0.9:8000` por tu URL real

### Paso 4: Ejecuta o prueba
```bash
# Python
python zodiac_api.py

# PHP
php zodiac_client.php

# JavaScript: abre en navegador
```

### Paso 5: Procesa los datos
Los datos llegan como JSON. Úsalos en tu aplicación.

---

## ✅ Verificación Rápida

¿Qué debo verificar después de consumir la API?

- [ ] La API retorna datos correctos
- [ ] Manejo de errores implementado
- [ ] Datos se muestran en mi app
- [ ] No hay problemas de CORS
- [ ] Velocidad es aceptable

---

**¿Ya elegiste tu opción?** Dime cuál quieres usar y te ayudo a implementarla. 🚀
