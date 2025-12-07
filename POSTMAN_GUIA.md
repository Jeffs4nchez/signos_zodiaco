# Prueba 1: GET todos los signos
curl http://192.168.0.9:8000/api/zodiac/signs

# Prueba 2: POST tu signo
curl -X POST "http://192.168.0.9:8000/api/zodiac" `
  -H "Content-Type: application/json" `
  -d '{"birth_date":"1990-05-03"}'

# Prueba 3: GET signo específico
curl http://192.168.0.9:8000/api/zodiac/signs/Tauro

# Prueba 4: POST compatibilidad
curl -X POST "http://192.168.0.9:8000/api/zodiac/compatibility" `
  -H "Content-Type: application/json" `
  -d '{"sign1":"Tauro","sign2":"Virgo"}'# 📮 Guía Completa: Probar Zodiac API con Postman

## 1️⃣ Instalación de Postman

### Paso 1: Descargar Postman
- Ve a: https://www.postman.com/downloads/
- Descarga para Windows
- Ejecuta el instalador
- Sigue los pasos de instalación

### Paso 2: Abrir Postman
Haz doble click en el icono de Postman

Verás una pantalla así:
```
┌─────────────────────────────────┐
│ Postman                         │
│                                 │
│ + New  Collections  Workspaces  │
│                                 │
│ [Crear nueva solicitud]         │
└─────────────────────────────────┘
```

---

## 2️⃣ Crear tu Primera Solicitud GET

### Obtener Todos los Signos

**Paso 1: Crea una nueva solicitud**
- Click en "+ New" o "Ctrl + N"
- Selecciona "HTTP Request"

**Paso 2: Configura la solicitud**

```
┌─────────────────────────────────────────────────┐
│ GET ▼  │ http://192.168.0.9:8000/api/zodiac/signs │ Send │
└─────────────────────────────────────────────────┘
```

Rellena así:
- **Método**: GET (ya está por defecto)
- **URL**: `http://192.168.0.9:8000/api/zodiac/signs`

**Paso 3: Click en "Send"**

**Respuesta esperada:**
```json
{
  "success": true,
  "message": "Signos zodiacales obtenidos correctamente",
  "data": {
    "count": 12,
    "signs": [
      {
        "name": "Capricornio",
        "date_range": "22 de diciembre - 19 de enero",
        "symbol": "♑",
        "element": "Tierra",
        "description": "Capricornio es un signo de tierra...",
        "compatible_signs": ["Tauro", "Virgo", "Escorpio", "Piscis"]
      },
      ...
    ]
  }
}
```

✅ ¡Si ves esto, significa que tu API funciona!

---

## 3️⃣ Prueba POST: Obtener tu Signo por Fecha

### Paso 1: Crea nueva solicitud
- Click en "+ New"
- "HTTP Request"

### Paso 2: Configura

**Método y URL:**
```
POST ▼  │ http://192.168.0.9:8000/api/zodiac
```

**Headers:**
- Click en la pestaña "Headers"
- Agrega:
  - **Key**: `Content-Type`
  - **Value**: `application/json`

```
┌──────────────┬──────────────────────┐
│ Content-Type │ application/json      │
└──────────────┴──────────────────────┘
```

**Body (Datos):**
- Click en pestaña "Body"
- Selecciona "raw"
- En el dropdown, elige "JSON"
- Pega esto:

```json
{
  "birth_date": "1990-05-03"
}
```

Verás así:
```
┌──────────────────────────────────┐
│ Body │ Headers │ ...              │
├──────────────────────────────────┤
│ ○ form-data                      │
│ ○ x-www-form-urlencoded        │
│ ● raw                           │
│      ▼ JSON                      │
│                                  │
│ {                                │
│   "birth_date": "1990-05-03"    │
│ }                                │
└──────────────────────────────────┘
```

### Paso 3: Click en "Send"

**Respuesta:**
```json
{
  "success": true,
  "message": "Signo zodiacal obtenido correctamente",
  "data": {
    "birth_date": "1990-05-03",
    "age": 34,
    "zodiac_sign": "Tauro",
    "symbol": "♉",
    "date_range": "20 de abril - 20 de mayo",
    "element": "Tierra",
    "description": "Tauro es un signo de tierra...",
    "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"],
    "message": "¡Hola! Eres del signo zodiacal Tauro. ♉"
  }
}
```

✅ ¡Perfecto! Obtienes tu signo.

---

## 4️⃣ Prueba GET: Obtener un Signo Específico

### Paso 1: Nueva solicitud
- "+ New" → "HTTP Request"

### Paso 2: Configura

```
GET ▼  │ http://192.168.0.9:8000/api/zodiac/signs/Tauro
```

- **Método**: GET
- **URL**: `http://192.168.0.9:8000/api/zodiac/signs/Tauro`
- Sin necesidad de Body ni Headers especiales

### Paso 3: Send

**Respuesta:**
```json
{
  "success": true,
  "message": "Signo 'Tauro' obtenido correctamente",
  "data": {
    "name": "Tauro",
    "symbol": "♉",
    "date_range": "20 de abril - 20 de mayo",
    "element": "Tierra",
    "description": "...",
    "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"]
  }
}
```

---

## 5️⃣ Prueba POST: Compatibilidad

### Paso 1: Nueva solicitud

```
POST ▼  │ http://192.168.0.9:8000/api/zodiac/compatibility
```

### Paso 2: Headers

```
Key: Content-Type
Value: application/json
```

### Paso 3: Body (raw, JSON)

```json
{
  "sign1": "Tauro",
  "sign2": "Virgo"
}
```

### Paso 4: Send

**Respuesta:**
```json
{
  "success": true,
  "message": "Compatibilidad calculada correctamente",
  "data": {
    "sign1": "Tauro",
    "sign2": "Virgo",
    "compatible": true,
    "compatibility_message": "¡Excelente compatibilidad! Tauro y Virgo comparten el elemento Tierra..."
  }
}
```

---

## 📋 Resumen de Pruebas

| Prueba | Método | URL | Body |
|--------|--------|-----|------|
| 1. Todos los signos | GET | `/api/zodiac/signs` | No |
| 2. Tu signo | POST | `/api/zodiac` | `{"birth_date": "YYYY-MM-DD"}` |
| 3. Signo específico | GET | `/api/zodiac/signs/{name}` | No |
| 4. Compatibilidad | POST | `/api/zodiac/compatibility` | `{"sign1": "X", "sign2": "Y"}` |

---

## 🎯 Casos de Prueba Recomendados

### Test 1: Verificar respuesta exitosa
```
✓ Status: 200 OK
✓ success: true
✓ Contiene datos
```

### Test 2: Verificar formato JSON
```
✓ Response es JSON válido
✓ Estructura correcta
✓ Campos presentes
```

### Test 3: Probar con fechas diferentes
```
Prueba con:
- Tu fecha real
- 01/01/1990
- 25/12/2000
- 31/12/1985
```

### Test 4: Probar errores
```
URL inválida:
GET /api/zodiac/signs/Inexistente

Body inválido:
POST /api/zodiac
{ "birth_date": "fecha-inválida" }
```

---

## 💾 Guardar tus Pruebas en una Colección

### Paso 1: Crear Colección
- Click en "Collections" (izquierda)
- Click en "+" o "New Collection"
- Nombre: "Zodiac API Tests"
- Click "Create"

### Paso 2: Agregar solicitudes
Para cada solicitud:
1. Haz la solicitud
2. Click en "Save"
3. Selecciona "Save to Zodiac API Tests"
4. Dale nombre descriptivo

### Paso 3: Organizar
```
Zodiac API Tests/
├── GET - Todos los signos
├── POST - Mi signo
├── GET - Un signo específico
└── POST - Compatibilidad
```

Ahora puedes correr todas las pruebas de una vez con "Run Collection"

---

## 🔍 Ver Detalles de la Respuesta

En Postman, verás varias pestañas:

### Pestaña "Response"
```
┌─────────────────────────────────┐
│ Body │ Headers │ Status │ Time  │
├─────────────────────────────────┤
│ {                               │
│   "success": true,              │
│   "data": {...}                │
│ }                               │
└─────────────────────────────────┘
```

### Status Code
```
200 OK         ✅ Éxito
400 Bad Request ❌ Error en datos
404 Not Found   ❌ Recurso no existe
500 Error       ❌ Error servidor
```

### Response Time
Verás cuánto tardó la API:
```
200ms (rápido ✓)
```

---

## 🛠️ Tips Útiles

### Tip 1: Variables en Postman

Crea una variable para la URL base:

```
1. Click en el ojo (Environment)
2. "Add" new environment
3. Nombre: "Zodiac API Local"
4. Variable: "base_url"
5. Value: "http://192.168.0.9:8000"
```

Luego usa en URLs:
```
{{base_url}}/api/zodiac/signs
```

### Tip 2: Pre-scripts (Ejecutar antes)

En "Pre-request Script":
```javascript
// Log antes de enviar
console.log('Enviando solicitud a: ' + request.url);
```

### Tip 3: Tests (Verificar respuesta)

En "Tests":
```javascript
// Verificar que es exitoso
pm.test("Status es 200", function() {
    pm.response.to.have.status(200);
});

// Verificar datos
pm.test("Contiene success", function() {
    var jsonData = pm.response.json();
    pm.expect(jsonData.success).to.eql(true);
});

// Verificar estructura
pm.test("Contiene zodiac_sign", function() {
    var jsonData = pm.response.json();
    pm.expect(jsonData.data).to.have.property('zodiac_sign');
});
```

---

## 📸 Pantalla Completa de Postman

```
┌──────────────────────────────────────────────────────────┐
│ File  Edit  View  Help                         [☰] [←→]  │
├──────────────────────────────────────────────────────────┤
│ My Workspace  Collections ▼                              │
├──────────────────────────────────────────────────────────┤
│                                                           │
│ ┌─────────────────────┐  ┌──────────────────────────────┐│
│ │ Collections         │  │ POST                         ││
│ │                     │  │ http://192.168.0.9:8000/api/ ││
│ │ Zodiac API Tests    │  │ zodiac                       ││
│ │ ├─ GET Signos       │  │                              ││
│ │ ├─ POST Mi Signo  ✓ │  │ [Params] [Headers] [Body]   ││
│ │ ├─ GET Signo        │  │                              ││
│ │ └─ POST Compatib    │  │ Body ▼                       ││
│ │                     │  │ ● raw   JSON ▼              ││
│ │                     │  │                              ││
│ │                     │  │ {                            ││
│ │                     │  │   "birth_date": "1990-05-03"││
│ │                     │  │ }                            ││
│ │                     │  │                              ││
│ │                     │  │  [Send] [Save]              ││
│ └─────────────────────┘  └──────────────────────────────┘│
│                                                           │
│ Response:                                                │
│ Status: 200 OK  Time: 45ms  Size: 2.5 KB               │
│                                                           │
│ {                                                         │
│   "success": true,                                       │
│   "message": "Signo zodiacal obtenido correctamente",   │
│   "data": {                                              │
│     "zodiac_sign": "Tauro",                             │
│     "symbol": "♉"                                       │
│   }                                                      │
│ }                                                         │
└──────────────────────────────────────────────────────────┘
```

---

## ✅ Checklist de Pruebas

- [ ] Descargué Postman
- [ ] Hice prueba GET /api/zodiac/signs (funciona)
- [ ] Hice prueba POST /api/zodiac con mi fecha
- [ ] Hice prueba GET /api/zodiac/signs/Tauro
- [ ] Hice prueba POST /api/zodiac/compatibility
- [ ] Guardé todo en una Collection
- [ ] Creo que todo está funcionando ✓

---

## 🚀 Próximos Pasos

Después de probar con Postman:
1. ✅ Integra en tu app
2. ✅ Prueba desde otro dispositivo
3. ✅ Haz push a GitHub
4. ✅ Despliega a producción

---

**¿Listo para probar?** 🎯

1. Abre Postman
2. Crea solicitud GET a `http://192.168.0.9:8000/api/zodiac/signs`
3. Click Send
4. ¡Deberías ver los 12 signos!

Si hay problemas, verifica:
- ✓ Tu servidor Laravel está corriendo
- ✓ La URL es correcta
- ✓ Estás en la misma red (192.168.0.x)
