# 🔮 Zodiac Sign API - Servicio Web de Signos Zodiacales

Una aplicación Laravel moderna que proporciona un servicio web completo para determinar el signo zodiacal de una persona según su fecha de nacimiento, incluyendo descripciones detalladas y compatibilidades.

## ✨ Características

- 🎯 **Determinación de Signo Zodiacal**: Calcula el signo zodiacal exacto basado en la fecha de nacimiento
- 📊 **Información Detallada**: Proporciona descripciones completas de cada signo zodiacal
- 💕 **Compatibilidad**: Verifica la compatibilidad entre dos signos zodiacales
- 🌐 **API RESTful**: Endpoints JSON para integración con otras aplicaciones
- 🎨 **Interfaz Web Moderna**: Interfaz responsiva y atractiva
- 📱 **Responsive Design**: Compatible con dispositivos móviles y de escritorio
- 🔍 **Cálculo de Edad**: Calcula automáticamente la edad del usuario

## 🛠️ Requisitos

- PHP 8.1+
- Laravel 12+
- Composer
- XAMPP (para servidor local)

## 📦 Instalación

### 1. Clonar o Descargar el Proyecto

```bash
cd C:\xampp\htdocs\programas\zodiac-api
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 4. Iniciar el Servidor

```bash
php artisan serve
```

Por defecto, la aplicación estará disponible en `http://localhost:8000`

## 🚀 Uso

### Interfaz Web

1. Accede a `http://localhost:8000/zodiac`
2. Ingresa tu fecha de nacimiento
3. ¡Descubre tu signo zodiacal!

### API RESTful

#### 1. Obtener Signo Zodiacal

**Endpoint**: `POST /api/zodiac`

**Descripción**: Obtiene el signo zodiacal de una persona basado en su fecha de nacimiento.

**Parámetros**:
```json
{
    "birth_date": "1990-05-15"
}
```

**Formatos de Fecha Aceptados**:
- `YYYY-MM-DD` (ej: 1990-05-15)
- `DD-MM-YYYY` (ej: 15-05-1990)
- `DD/MM/YYYY` (ej: 15/05/1990)

**Respuesta Exitosa** (200):
```json
{
    "success": true,
    "birth_date": "1990-05-15",
    "age": 34,
    "zodiac_sign": "Tauro",
    "symbol": "♉",
    "date_range": "20 de abril - 20 de mayo",
    "element": "Tierra",
    "description": "Tauro es un signo de tierra caracterizado por su estabilidad...",
    "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"],
    "message": "¡Hola! Eres del signo zodiacal Tauro. ♉"
}
```

**Respuesta de Error** (200):
```json
{
    "success": false,
    "error": "Formato de fecha no válido. Use: YYYY-MM-DD o DD-MM-YYYY"
}
```

#### 2. Obtener Todos los Signos Zodiacales

**Endpoint**: `GET /api/zodiac/signs`

**Descripción**: Obtiene la lista completa de todos los 12 signos zodiacales con su información.

**Respuesta Exitosa** (200):
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
            "compatible_signs": ["Tauro", "Virgo", "Escorpio", "Piscis"]
        },
        ...
    ]
}
```

#### 3. Obtener un Signo Específico

**Endpoint**: `GET /api/zodiac/signs/{sign}`

**Descripción**: Obtiene la información de un signo zodiacal específico.

**Ejemplo**:
```
GET /api/zodiac/signs/Tauro
```

**Respuesta Exitosa** (200):
```json
{
    "success": true,
    "sign": {
        "name": "Tauro",
        "date_range": "20 de abril - 20 de mayo",
        "symbol": "♉",
        "element": "Tierra",
        "description": "Tauro es un signo de tierra...",
        "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"]
    }
}
```

**Respuesta de Error** (404):
```json
{
    "success": false,
    "error": "El signo 'InvalidSign' no existe."
}
```

#### 4. Verificar Compatibilidad entre Dos Signos

**Endpoint**: `POST /api/zodiac/compatibility`

**Descripción**: Obtiene el nivel de compatibilidad entre dos signos zodiacales.

**Parámetros**:
```json
{
    "sign1": "Tauro",
    "sign2": "Virgo"
}
```

**Respuesta Exitosa** (200):
```json
{
    "success": true,
    "sign1": "Tauro",
    "sign2": "Virgo",
    "compatibility": "Compatible",
    "percentage": 85,
    "message": "Tauro y Virgo son signos compatibles. Comparten elementos o características que permiten una buena armonía."
}
```

## 📚 Ejemplos de Uso

### Con cURL

```bash
# Obtener signo zodiacal
curl -X POST http://localhost:8000/api/zodiac \
  -H "Content-Type: application/json" \
  -d '{"birth_date":"1995-12-25"}'

# Obtener todos los signos
curl http://localhost:8000/api/zodiac/signs

# Obtener un signo específico
curl http://localhost:8000/api/zodiac/signs/Leo

# Verificar compatibilidad
curl -X POST http://localhost:8000/api/zodiac/compatibility \
  -H "Content-Type: application/json" \
  -d '{"sign1":"Leo","sign2":"Sagitario"}'
```

### Con JavaScript/Fetch

```javascript
// Obtener signo zodiacal
fetch('http://localhost:8000/api/zodiac', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        birth_date: '1995-12-25'
    })
})
.then(response => response.json())
.then(data => console.log(data));

// Obtener todos los signos
fetch('http://localhost:8000/api/zodiac/signs')
    .then(response => response.json())
    .then(data => console.log(data));
```

### Con Python

```python
import requests
import json

# Obtener signo zodiacal
url = 'http://localhost:8000/api/zodiac'
data = {'birth_date': '1995-12-25'}
response = requests.post(url, json=data)
print(response.json())

# Obtener todos los signos
url = 'http://localhost:8000/api/zodiac/signs'
response = requests.get(url)
print(response.json())
```

## 📋 Estructura del Proyecto

```
zodiac-api/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ZodiacController.php      # Controlador principal
│   └── Services/
│       └── ZodiacService.php             # Servicio de lógica zodiacal
├── routes/
│   ├── api.php                           # Rutas de la API
│   └── web.php                           # Rutas web
├── resources/
│   └── views/
│       ├── zodiac/
│       │   ├── form.blade.php            # Formulario principal
│       │   └── result.blade.php          # Página de resultados
├── config/                               # Archivos de configuración
├── database/                             # Migraciones y seeders
└── public/
    └── index.php                         # Punto de entrada
```

## 🌟 Signos Zodiacales Incluidos

1. ♈ **Aries** (21 de marzo - 19 de abril) - Fuego
2. ♉ **Tauro** (20 de abril - 20 de mayo) - Tierra
3. ♊ **Géminis** (21 de mayo - 20 de junio) - Aire
4. ♋ **Cáncer** (21 de junio - 22 de julio) - Agua
5. ♌ **León** (23 de julio - 22 de agosto) - Fuego
6. ♍ **Virgo** (23 de agosto - 22 de septiembre) - Tierra
7. ♎ **Libra** (23 de septiembre - 22 de octubre) - Aire
8. ♏ **Escorpio** (23 de octubre - 21 de noviembre) - Agua
9. ♐ **Sagitario** (22 de noviembre - 21 de diciembre) - Fuego
10. ♑ **Capricornio** (22 de diciembre - 19 de enero) - Tierra
11. ♒ **Acuario** (20 de enero - 18 de febrero) - Aire
12. ♓ **Piscis** (19 de febrero - 20 de marzo) - Agua

## 🔐 Seguridad

- Validación de entrada en todos los endpoints
- Manejo seguro de excepciones
- Protección CSRF en formularios web
- Respuestas JSON limpias y estructuradas

## 🐛 Solución de Problemas

### Error: "Module openssl is already loaded"
Esta es una advertencia de PHP y no afecta el funcionamiento. Puede ignorarse.

### Error 404 en rutas API
Asegúrate de acceder con la URL correcta: `http://localhost:8000/api/zodiac/...`

### Errores de permiso en XAMPP
Ejecuta el servidor de desarrollo de Laravel en lugar de usar XAMPP directamente.

## 📄 Licencia

Este proyecto está disponible bajo licencia MIT.

## 👨‍💻 Autor

Zodiac Sign API - Servicio Web de Signos Zodiacales

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Siéntete libre de abrir issues o pull requests.

## 📞 Contacto

Para reportar problemas o sugerir mejoras, contacta al desarrollador.

---

**Última actualización**: Diciembre 2025

¡Disfruta descubriendo tu signo zodiacal! ♈♉♊♋♌♍♎♏♐♑♒♓
