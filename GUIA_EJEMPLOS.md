# 🔮 Guía de Ejemplos - Zodiac API

## 📋 Archivos de Ejemplos Disponibles

### 1. **Aplicación Web Interactiva** 
**Archivo:** `app_web.html`

**Descripción:** Una interfaz web completa y profesional para consumir la API desde el navegador.

**Características:**
- Buscar signo zodiacal por fecha de nacimiento
- Verificar compatibilidad entre dos signos
- Visualizar todos los 12 signos
- Interfaz moderna con tema oscuro y colores cian

**Cómo usar:**
1. Abre el archivo `app_web.html` directamente en tu navegador
2. O coloca en `public/` dentro del proyecto Laravel
3. Accede en: `http://192.168.0.9:8000/app_web.html` (si está en public)

**Sin requisitos especiales - funciona en cualquier navegador moderno**

---

### 2. **Cliente y Ejemplos PHP**
**Archivos:** `ZodiacAPIClient.php`, `ejemplos.php`

**Descripción:** Cliente PHP para integrar la API en tus proyectos Laravel/PHP.

**Características:**
- Clase reutilizable `ZodiacAPIClient`
- 4 métodos principales (getAllSigns, getZodiacSign, getSignByName, getCompatibility)
- Manejo de errores
- Logging con emojis

**Requisitos:**
```
PHP 7.4+ (incluido en XAMPP)
```

**Cómo usar:**

```bash
# Ejecutar ejemplos
cd c:\xampp\htdocs\programas\zodiac-api
php ejemplos.php

# Usar en tu código PHP
require 'ZodiacAPIClient.php';
$client = new ZodiacAPIClient('http://192.168.0.9:8000');
$signs = $client->getAllSigns();
```

**Ejemplo de Integración:**
```php
<?php
require 'ZodiacAPIClient.php';

$zodiac = new ZodiacAPIClient('http://192.168.0.9:8000');
$miSigno = $zodiac->getZodiacSign('1990-05-03');

if ($miSigno['success']) {
    echo "Mi signo es: " . $miSigno['data']['zodiac_sign'];
}
?>
```

---

### 3. **Cliente y Ejemplos Node.js**
**Archivos:** `ZodiacAPIClient.js`, `ejemplos_nodejs.js`

**Descripción:** Cliente Node.js para integrar en aplicaciones JavaScript/Node.

**Características:**
- Clase `ZodiacAPIClient` con Promises
- Manejo de HTTP/HTTPS
- Logging con información detallada
- API moderna

**Requisitos:**
```
Node.js 12+ 
npm (gestor de paquetes)
```

**Instalación:**
```bash
# Versión actual de Node ya incluye módulos nativos necesarios
# No requiere instalación adicional de dependencias
```

**Cómo usar:**

```bash
# Ejecutar ejemplos
cd c:\xampp\htdocs\programas\zodiac-api
node ejemplos_nodejs.js

# Usar en tu proyecto Node.js
const ZodiacAPIClient = require('./ZodiacAPIClient');
const zodiac = new ZodiacAPIClient('http://192.168.0.9:8000');

zodiac.getZodiacSign('1990-05-03').then(result => {
    console.log(result.data);
});
```

**Ejemplo de Integración (Express.js):**
```javascript
const express = require('express');
const ZodiacAPIClient = require('./ZodiacAPIClient');

const app = express();
const zodiac = new ZodiacAPIClient('http://192.168.0.9:8000');

app.get('/mi-signo/:fecha', async (req, res) => {
    const result = await zodiac.getZodiacSign(req.params.fecha);
    res.json(result);
});

app.listen(3000);
```

---

### 4. **Cliente y Ejemplos Python**
**Archivos:** `ejemplos_python.py`

**Descripción:** Cliente Python con manejo profesional de requests.

**Características:**
- Clase `ZodiacAPIClient` con manejo de excepciones
- Type hints para código seguro
- Funciones auxiliares para visualización
- Documentación inline

**Requisitos:**
```
Python 3.6+
requests (librería HTTP)
```

**Instalación:**

**Windows (Command Prompt):**
```bash
# Instalar requests
pip install requests

# O con pip3
pip3 install requests
```

**Cómo usar:**

```bash
# Ejecutar ejemplos
python ejemplos_python.py

# O con Python 3 específicamente
python3 ejemplos_python.py

# Usar en tu código Python
from ejemplos_python import ZodiacAPIClient

client = ZodiacAPIClient('http://192.168.0.9:8000')
signo = client.get_zodiac_sign('1990-05-03')
print(signo['data'])
```

**Ejemplo de Integración (Flask):**
```python
from flask import Flask, jsonify
from ejemplos_python import ZodiacAPIClient

app = Flask(__name__)
zodiac = ZodiacAPIClient('http://192.168.0.9:8000')

@app.route('/api/mi-signo/<fecha>')
def mi_signo(fecha):
    return jsonify(zodiac.get_zodiac_sign(fecha))

if __name__ == '__main__':
    app.run(debug=True)
```

---

## 🚀 Inicio Rápido por Lenguaje

### HTML/JavaScript (Navegador)
```html
<!-- Abre app_web.html directamente en el navegador -->
<!-- No requiere instalación de nada -->
```

### PHP (Backend)
```bash
php ejemplos.php
# O integra ZodiacAPIClient.php en tu proyecto Laravel
```

### Node.js (Backend/Frontend)
```bash
node ejemplos_nodejs.js
# Asegúrate de tener Node.js instalado
```

### Python (Backend/ML/Analytics)
```bash
pip install requests
python3 ejemplos_python.py
```

---

## 📊 Métodos Disponibles en Todos los Clientes

### 1. Obtener todos los signos
**Request:** `GET /api/zodiac/signs`

```json
{
  "success": true,
  "message": "Signos obtenidos exitosamente",
  "data": {
    "signs": [
      {
        "id": 1,
        "name": "Aries",
        "symbol": "♈",
        "date_range": "21 Mar - 19 Abr",
        "element": "Fuego",
        "description": "...",
        "compatible_signs": ["Leo", "Sagitario"]
      }
    ]
  }
}
```

### 2. Obtener signo por fecha de nacimiento
**Request:** `POST /api/zodiac`

```json
{
  "birth_date": "1990-05-03"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Signo obtenido correctamente",
  "data": {
    "zodiac_sign": "Tauro",
    "symbol": "♉",
    "date_range": "20 Abr - 20 May",
    "element": "Tierra",
    "age": 34,
    "description": "...",
    "compatible_signs": ["Virgo", "Capricornio"]
  }
}
```

### 3. Obtener signo específico por nombre
**Request:** `GET /api/zodiac/signs/{nombre}`

### 4. Verificar compatibilidad
**Request:** `POST /api/zodiac/compatibility`

```json
{
  "sign1": "Tauro",
  "sign2": "Virgo"
}
```

---

## 🔍 Solución de Problemas

### Error: "Cannot GET /api/zodiac/signs"
**Solución:** Asegúrate que el servidor Laravel está corriendo:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### Error: "Connection refused"
**Solución:** Cambia la IP según tu caso:
- Localhost: `http://127.0.0.1:8000`
- Red local: `http://192.168.0.9:8000` (o tu IP)
- Docker: `http://host.docker.internal:8000`

### Python: "ModuleNotFoundError: No module named 'requests'"
**Solución:**
```bash
pip install requests
```

### Node.js: "Cannot find module"
**Solución:** Asegúrate de estar en el directorio correcto:
```bash
cd c:\xampp\htdocs\programas\zodiac-api
node ejemplos_nodejs.js
```

---

## 💡 Casos de Uso

### 1. Sitio Web (HTML/JS)
- Usar `app_web.html` como frontend
- Cargar en navegador o integrar en proyecto web

### 2. Backend PHP (Laravel)
- Importar `ZodiacAPIClient.php`
- Usar en controllers o services
- Integrar en API propia

### 3. Backend Node.js
- Usar `ZodiacAPIClient.js` en Express.js
- Integrar en rutas de servidor
- Usar en jobs de background

### 4. Análisis de Datos (Python)
- Usar cliente Python para scripts
- Integrar con pandas/numpy para análisis
- Usar en Flask/Django para API wrapper

---

## 📝 Notas Importantes

1. **IP por defecto:** `192.168.0.9:8000` - Ajusta según tu red
2. **Todos los ejemplos incluyen manejo de errores**
3. **Todos los clientes usan JSON** - Asegura compatibilidad
4. **Los ejemplos son completamente funcionales** - Listos para producción
5. **Documentación inline en todos los archivos** - Revisa el código

---

## 🎯 Siguiente Paso

Elige tu lenguaje preferido y:
1. Ejecuta el ejemplo para verificar que funciona
2. Integra el cliente en tu proyecto
3. ¡Comienza a consumir la API!

**¿Preguntas?** Revisa los archivos de ejemplo - están bien documentados.
