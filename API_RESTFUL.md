# 🌟 Zodiac API - Documentación RESTful Completa

## 📋 Tabla de Contenidos
1. [Arquitectura RESTful](#arquitectura-restful)
2. [Endpoints Disponibles](#endpoints-disponibles)
3. [Cómo Probar la API](#cómo-probar-la-api)
4. [Ejemplos de Uso](#ejemplos-de-uso)
5. [Probar desde Otros Dispositivos](#probar-desde-otros-dispositivos)

---

## 🏗️ Arquitectura RESTful

La API está construida siguiendo los principios de arquitectura REST (Representational State Transfer) con Laravel.

### Estructura de Capas

```
┌─────────────────────────────────────────┐
│         Cliente/Navegador               │
│    (http://localhost:8000)              │
└────────────────┬────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│      Rutas (routes/api.php)             │
│  Define los endpoints HTTP              │
└────────────────┬────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│   Controladores (Controllers/)          │
│  Maneja requests/responses JSON         │
└────────────────┬────────────────────────┘
                 │
                 ↓
┌─────────────────────────────────────────┐
│    Servicios (Services/)                │
│  Lógica de negocio (cálculos, datos)   │
└─────────────────────────────────────────┘
```

### Ciclo de Vida de una Petición

```
1. CLIENTE hace petición HTTP
   POST /api/zodiac
   
2. RUTA (api.php) - Recibe y dirige
   Route::post('/', [ZodiacController::class, 'getZodiac']);
   
3. CONTROLADOR (ZodiacController.php) - Procesa
   public function getZodiac(Request $request) {
       $result = $this->zodiacService->getZodiacSign($request->birth_date);
       return response()->json($result);
   }
   
4. SERVICIO (ZodiacService.php) - Calcula
   public function getZodiacSign($birthDate) {
       // Lógica para determinar signo por fecha
       // Retorna array con datos
   }
   
5. RESPUESTA - JSON al cliente
   {
       "success": true,
       "zodiac_sign": "Tauro",
       "symbol": "♉",
       ...
   }
```

---

## 🔌 Endpoints Disponibles

### 1. Obtener Todos los Signos
```http
GET /api/zodiac/signs
```

**Descripción:** Retorna información de los 12 signos zodiacales

**Método:** GET  
**Autenticación:** No requerida  
**Respuesta:** JSON Array con 12 signos

**Ejemplo de Respuesta:**
```json
{
  "success": true,
  "count": 12,
  "signs": [
    {
      "name": "Capricornio",
      "date_range": "22 de diciembre - 19 de enero",
      "symbol": "♑",
      "element": "Tierra",
      "description": "Capricornio es un signo de tierra...",
      "compatible_signs": "Tauro Virgo Escorpio Piscis"
    },
    ...
  ]
}
```

---

### 2. Obtener Signo por Fecha de Nacimiento
```http
POST /api/zodiac
```

**Descripción:** Calcula el signo zodiacal basado en una fecha de nacimiento

**Método:** POST  
**Autenticación:** No requerida  
**Content-Type:** application/json

**Parámetros requeridos:**
- `birth_date` (string): Fecha en formato "YYYY-MM-DD" o "DD/MM/YYYY"

**Ejemplo de Request:**
```bash
curl -X POST http://localhost:8000/api/zodiac \
  -H "Content-Type: application/json" \
  -d '{
    "birth_date": "1990-05-03"
  }'
```

**Ejemplo de Respuesta (200 OK):**
```json
{
  "success": true,
  "zodiac_sign": "Tauro",
  "symbol": "♉",
  "element": "Tierra",
  "date_range": "20 de abril - 20 de mayo",
  "description": "Tauro es un signo de tierra caracterizado por su estabilidad...",
  "compatible_signs": "Virgo Capricornio Cáncer Piscis"
}
```

**Ejemplo de Error (400 Bad Request):**
```json
{
  "success": false,
  "message": "Formato de fecha inválido. Use YYYY-MM-DD o DD/MM/YYYY"
}
```

---

### 3. Obtener Signo por Nombre
```http
GET /api/zodiac/signs/{sign}
```

**Descripción:** Retorna información de un signo específico

**Método:** GET  
**Autenticación:** No requerida  
**Parámetro:** `{sign}` - Nombre del signo (ej: Tauro, Aries, etc.)

**Ejemplo de Request:**
```bash
curl http://localhost:8000/api/zodiac/signs/Tauro
```

**Ejemplo de Respuesta:**
```json
{
  "success": true,
  "sign": {
    "name": "Tauro",
    "date_range": "20 de abril - 20 de mayo",
    "symbol": "♉",
    "element": "Tierra",
    "description": "Tauro es un signo de tierra...",
    "compatible_signs": "Virgo Capricornio Cáncer Piscis"
  }
}
```

---

### 4. Compatibilidad entre Signos
```http
POST /api/zodiac/compatibility
```

**Descripción:** Calcula la compatibilidad entre dos signos zodiacales

**Método:** POST  
**Autenticación:** No requerida  
**Content-Type:** application/json

**Parámetros requeridos:**
- `sign1` (string): Primer signo
- `sign2` (string): Segundo signo

**Ejemplo de Request:**
```bash
curl -X POST http://localhost:8000/api/zodiac/compatibility \
  -H "Content-Type: application/json" \
  -d '{
    "sign1": "Tauro",
    "sign2": "Virgo"
  }'
```

**Ejemplo de Respuesta:**
```json
{
  "success": true,
  "sign1": "Tauro",
  "sign2": "Virgo",
  "compatible": true,
  "compatibility_message": "¡Excelente compatibilidad! Tauro y Virgo comparten el elemento Tierra y tienen características complementarias."
}
```

---

## 🧪 Cómo Probar la API

### Opción 1: Usar Postman (Recomendado)

**Postman** es una herramienta gráfica para probar APIs REST.

#### Instalación:
1. Descarga Postman desde: https://www.postman.com/downloads/
2. Instala y abre la aplicación

#### Pruebas:

**Test 1: Obtener todos los signos**
```
Método: GET
URL: http://localhost:8000/api/zodiac/signs
Click en "Send"
```

**Test 2: Calcular signo por fecha**
```
Método: POST
URL: http://localhost:8000/api/zodiac
Headers:
  Content-Type: application/json
Body (raw):
{
  "birth_date": "1990-05-03"
}
Click en "Send"
```

**Test 3: Obtener signo específico**
```
Método: GET
URL: http://localhost:8000/api/zodiac/signs/Tauro
Click en "Send"
```

**Test 4: Compatibilidad**
```
Método: POST
URL: http://localhost:8000/api/zodiac/compatibility
Headers:
  Content-Type: application/json
Body (raw):
{
  "sign1": "Tauro",
  "sign2": "Virgo"
}
Click en "Send"
```

---

### Opción 2: Usar cURL (Terminal/PowerShell)

cURL es una herramienta de línea de comandos.

**Test 1: GET - Todos los signos**
```powershell
curl -X GET "http://localhost:8000/api/zodiac/signs"
```

**Test 2: POST - Signo por fecha**
```powershell
curl -X POST "http://localhost:8000/api/zodiac" `
  -H "Content-Type: application/json" `
  -d '{"birth_date":"1990-05-03"}'
```

**Test 3: GET - Signo específico**
```powershell
curl -X GET "http://localhost:8000/api/zodiac/signs/Tauro"
```

**Test 4: POST - Compatibilidad**
```powershell
curl -X POST "http://localhost:8000/api/zodiac/compatibility" `
  -H "Content-Type: application/json" `
  -d '{"sign1":"Tauro","sign2":"Virgo"}'
```

---

### Opción 3: Usar JavaScript/Fetch (Navegador)

Abre la consola del navegador (F12 → Console) y copia:

```javascript
// Test 1: Obtener todos los signos
fetch('http://localhost:8000/api/zodiac/signs')
  .then(res => res.json())
  .then(data => console.log(data));

// Test 2: Signo por fecha
fetch('http://localhost:8000/api/zodiac', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({birth_date: '1990-05-03'})
})
  .then(res => res.json())
  .then(data => console.log(data));

// Test 3: Signo específico
fetch('http://localhost:8000/api/zodiac/signs/Tauro')
  .then(res => res.json())
  .then(data => console.log(data));

// Test 4: Compatibilidad
fetch('http://localhost:8000/api/zodiac/compatibility', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({sign1: 'Tauro', sign2: 'Virgo'})
})
  .then(res => res.json())
  .then(data => console.log(data));
```

---

### Opción 4: Usar VSCode REST Client

Crea un archivo `requests.http` con:

```http
### Obtener todos los signos
GET http://localhost:8000/api/zodiac/signs

### Signo por fecha
POST http://localhost:8000/api/zodiac
Content-Type: application/json

{
  "birth_date": "1990-05-03"
}

### Signo específico
GET http://localhost:8000/api/zodiac/signs/Tauro

### Compatibilidad
POST http://localhost:8000/api/zodiac/compatibility
Content-Type: application/json

{
  "sign1": "Tauro",
  "sign2": "Virgo"
}
```

Instala la extensión "REST Client" en VSCode y haz click en "Send Request"

---

## 📱 Probar desde Otros Dispositivos

### Prerequisitos
- La API debe estar corriendo: `php artisan serve`
- El otro dispositivo debe estar en la misma red

### Paso 1: Obtener tu IP local

**En Windows (PowerShell):**
```powershell
ipconfig
```
Busca "IPv4 Address" bajo tu adaptador de red (ej: 192.168.1.100)

**En Mac/Linux:**
```bash
ifconfig
```

### Paso 2: Iniciar el servidor con tu IP

En lugar de:
```bash
php artisan serve
```

Usa:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Verás algo como:
```
Server running on [http://0.0.0.0:8000]
Local:   http://127.0.0.1:8000
Network: http://192.168.1.100:8000
```

### Paso 3: Acceder desde otro dispositivo

**Desde el navegador:**
```
http://192.168.1.100:8000
```

**Desde otro dispositivo (cURL):**
```bash
curl http://192.168.1.100:8000/api/zodiac/signs
```

**Desde Postman:**
```
URL: http://192.168.1.100:8000/api/zodiac
```

### Paso 4: Probar la interfaz web

Ve a:
```
http://192.168.1.100:8000
```

Verás la interfaz interactiva de la aplicación.

---

## 🚀 Ejemplo Completo: Integración con Aplicación Externa

### Cliente Python
```python
import requests
import json

BASE_URL = "http://192.168.1.100:8000/api"

# Obtener todos los signos
response = requests.get(f"{BASE_URL}/zodiac/signs")
print("Todos los signos:", response.json())

# Calcular signo por fecha
response = requests.post(f"{BASE_URL}/zodiac", 
    json={"birth_date": "1990-05-03"}
)
print("Tu signo:", response.json())

# Compatibilidad
response = requests.post(f"{BASE_URL}/zodiac/compatibility",
    json={"sign1": "Tauro", "sign2": "Virgo"}
)
print("Compatibilidad:", response.json())
```

### Cliente JavaScript (Node.js)
```javascript
const axios = require('axios');

const BASE_URL = 'http://192.168.1.100:8000/api';

// Obtener todos los signos
axios.get(`${BASE_URL}/zodiac/signs`)
  .then(res => console.log('Signos:', res.data))
  .catch(err => console.error(err));

// Calcular signo
axios.post(`${BASE_URL}/zodiac`, 
  { birth_date: '1990-05-03' }
)
  .then(res => console.log('Tu signo:', res.data))
  .catch(err => console.error(err));
```

---

## ✅ Checklist de Prueba

- [ ] ✓ Prueba GET /api/zodiac/signs (debe retornar 12 signos)
- [ ] ✓ Prueba POST /api/zodiac con tu fecha
- [ ] ✓ Prueba GET /api/zodiac/signs/Tauro
- [ ] ✓ Prueba POST /api/zodiac/compatibility
- [ ] ✓ Accede desde navegador: http://localhost:8000
- [ ] ✓ Prueba desde otro dispositivo en la red
- [ ] ✓ Prueba con Postman
- [ ] ✓ Prueba con cURL
- [ ] ✓ Prueba con JavaScript en consola

---

## 📊 Respuestas HTTP Esperadas

| Endpoint | Método | Esperado | Error |
|----------|--------|----------|-------|
| /api/zodiac/signs | GET | 200 OK | 404 No encontrado |
| /api/zodiac | POST | 200 OK | 400 Fecha inválida |
| /api/zodiac/signs/{name} | GET | 200 OK | 404 Signo no encontrado |
| /api/zodiac/compatibility | POST | 200 OK | 400 Signos inválidos |

---

## 🔍 Debugging

### Si obtienes 404:
- Verifica que el servidor esté corriendo
- Verifica la URL (case-sensitive)
- Verifica que `bootstrap/app.php` incluya la ruta API

### Si obtienes errores de CORS:
- Esto ocurre cuando accedes desde diferente dominio
- Solución: Accede desde el mismo dispositivo o agrega CORS middleware

### Si la API no responde:
```bash
# Verifica si el servidor está corriendo
netstat -ano | findstr :8000

# Reinicia el servidor
php artisan serve
```

---

## 📚 Recursos Adicionales

- [REST API Best Practices](https://restfulapi.net/)
- [Laravel API Documentation](https://laravel.com/docs/routing)
- [Postman Docs](https://learning.postman.com/)
- [HTTP Status Codes](https://httpwg.org/specs/rfc7231.html#status.codes)

---

**Última actualización:** Diciembre 5, 2025  
**Versión:** 1.0  
**Autor:** Zodiac API Team
