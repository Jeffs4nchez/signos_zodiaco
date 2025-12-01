# 🔮 Zodiac Sign API - Proyecto Completo Listo

## ✅ Proyecto Completado sin Base de Datos

Tu proyecto **Zodiac Sign API** está completamente funcional y **sin dependencia de base de datos**. Todos los datos se almacenan temporalmente en memoria.

---

## 🚀 CÓMO INICIAR

### Opción 1: Desde PowerShell (Recomendado)

```powershell
cd C:\xampp\htdocs\programas\zodiac-api
php artisan serve
```

El servidor estará en: **http://localhost:8000**

### Opción 2: Usar el archivo batch

```
Doble-click en: iniciar_servidor.bat
```

---

## 📍 Rutas Disponibles

| Ruta | Tipo | Descripción |
|------|------|-------------|
| `/` | GET | 🏠 Página de inicio con documentación |
| `/zodiac` | GET | 🔮 Formulario web para descubrir signo |
| `/zodiac` | POST | Procesar fecha y mostrar resultado |
| `/tester.html` | GET | 🧪 Probador interactivo de API |
| `/api/zodiac` | POST | Obtener signo por fecha (JSON) |
| `/api/zodiac/signs` | GET | Listar todos los signos (JSON) |
| `/api/zodiac/signs/{name}` | GET | Obtener un signo específico (JSON) |
| `/api/zodiac/compatibility` | POST | Verificar compatibilidad (JSON) |

---

## 🌐 ACCESOS

### Interfaz Web
- **Página de Inicio**: http://localhost:8000
- **Descubrir Signo**: http://localhost:8000/zodiac
- **Probador API**: http://localhost:8000/tester.html

### API RESTful
- **Base URL**: http://localhost:8000/api

---

## 📚 EJEMPLOS DE USO

### 1️⃣ Obtener tu signo zodiacal (POST)

```powershell
# PowerShell
$body = @{ birth_date = "1990-05-15" } | ConvertTo-Json
Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac" `
  -Method POST `
  -ContentType "application/json" `
  -Body $body
```

**Respuesta:**
```json
{
  "success": true,
  "birth_date": "1990-05-15",
  "age": 34,
  "zodiac_sign": "Tauro",
  "symbol": "♉",
  "date_range": "20 de abril - 20 de mayo",
  "element": "Tierra",
  "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"],
  "message": "¡Hola! Eres del signo zodiacal Tauro. ♉"
}
```

### 2️⃣ Obtener todos los signos (GET)

```powershell
Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac/signs"
```

### 3️⃣ Obtener un signo específico (GET)

```powershell
Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac/signs/Tauro"
```

### 4️⃣ Compatibilidad entre dos signos (POST)

```powershell
$body = @{ 
  sign1 = "Tauro"
  sign2 = "Virgo" 
} | ConvertTo-Json

Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac/compatibility" `
  -Method POST `
  -ContentType "application/json" `
  -Body $body
```

---

## 📁 ESTRUCTURA DEL PROYECTO

```
zodiac-api/
├── app/
│   ├── Http/Controllers/
│   │   └── ZodiacController.php      ← Controlador principal
│   └── Services/
│       └── ZodiacService.php          ← Lógica de signos zodiacales
├── routes/
│   ├── api.php                        ← Rutas API
│   └── web.php                        ← Rutas web
├── resources/views/
│   ├── home.blade.php                 ← Página de inicio
│   └── zodiac/
│       ├── form.blade.php             ← Formulario web
│       └── result.blade.php           ← Página de resultados
├── public/
│   ├── index.php                      ← Punto de entrada
│   └── tester.html                    ← Probador de API
├── iniciar_servidor.bat               ← Script para Windows
├── INICIO_RAPIDO.md                   ← Guía rápida
├── README_ZODIAC_API.md               ← Documentación completa
└── EJEMPLOS_USO.php                   ← Ejemplos de código
```

---

## 🎯 CARACTERÍSTICAS PRINCIPALES

✅ **Sin Base de Datos** - Todo funciona en memoria  
✅ **API RESTful** - Endpoints JSON listos para usar  
✅ **Interfaz Web** - Aplicación web moderna y responsiva  
✅ **Probador Integrado** - Herramienta para probar la API  
✅ **Documentación Completa** - Guías y ejemplos  
✅ **12 Signos Zodiacales** - Con descripción y compatibilidad  
✅ **Cálculo de Edad** - Automático según fecha de nacimiento  
✅ **Múltiples Formatos** - Acepta varias formatos de fecha  

---

## 🛠️ ARCHIVOS IMPORTANTES

| Archivo | Descripción |
|---------|-------------|
| `app/Services/ZodiacService.php` | Lógica completa del servicio |
| `app/Http/Controllers/ZodiacController.php` | Controlador de rutas |
| `routes/api.php` | Rutas de la API |
| `routes/web.php` | Rutas web |
| `resources/views/home.blade.php` | Página de inicio |
| `public/tester.html` | Probador de API |
| `INICIO_RAPIDO.md` | Guía de inicio rápido |
| `README_ZODIAC_API.md` | Documentación completa |

---

## 🔍 ¿CÓMO FUNCIONA?

### ZodiacService.php
- Contiene todos los 12 signos zodiacales con sus datos
- Métodos para determinar el signo por fecha
- Calcula automáticamente la edad
- Verifica compatibilidad entre signos
- Todo está en memoria (sin acceso a base de datos)

### ZodiacController.php
- Maneja las peticiones HTTP
- Valida los datos de entrada
- Devuelve respuestas JSON o HTML
- 4 endpoints principales en la API

### Rutas
- **API** (`/api/zodiac/*`): Endpoints JSON para aplicaciones externas
- **Web** (`/zodiac`): Interfaz web para usuarios finales

---

## 📊 DATOS TEMPORALES - ¿QUÉ SIGNIFICA?

Significa que:
- ✅ No necesitas instalar base de datos
- ✅ No necesitas configurar migraciones
- ✅ Todo funciona "tal cual" sin dependencias externas
- ✅ Los datos se cargan en memoria al iniciar
- ✅ La información de signos zodiacales está hardcodeada en el código

Los datos **persisten mientras el servidor está corriendo**, pero se reinician cuando lo detienes.

---

## 🧪 PROBAR LA API

### Opción 1: Probador Integrado (Más Fácil)

1. Inicia el servidor: `php artisan serve`
2. Abre: http://localhost:8000/tester.html
3. ¡Usa la interfaz para probar los endpoints!

### Opción 2: cURL en PowerShell

```powershell
# Obtener signo
$body = '{"birth_date":"1995-05-15"}' | ConvertTo-Json
(Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac" `
  -Method POST -ContentType "application/json" -Body $body).Content | ConvertFrom-Json
```

### Opción 3: Usar Postman o Insomnia

- **Método**: POST
- **URL**: http://localhost:8000/api/zodiac
- **Body (JSON)**: `{"birth_date":"1995-05-15"}`

---

## 📞 SOLUCIÓN DE PROBLEMAS

### ❌ Error: "Module openssl is already loaded"
**Solución**: Esto es solo una advertencia y NO afecta el funcionamiento. Ignóralo.

### ❌ Error 404 en rutas
**Solución**: Asegúrate de usar http://localhost:8000 (con puerto 8000)

### ❌ Puerto 8000 ocupado
**Solución**: 
```powershell
php artisan serve --port=8001
```

### ❌ No se carga la página de inicio
**Solución**: Recarga el navegador o limpia el cache

---

## 📚 DOCUMENTACIÓN ADICIONAL

- **INICIO_RAPIDO.md** - Guía rápida de 5 minutos
- **README_ZODIAC_API.md** - Documentación completa con ejemplos
- **EJEMPLOS_USO.php** - Ejemplos de código en PHP

---

## 🎉 ¡LISTO!

Tu **Zodiac Sign API** está 100% funcional y lista para usar.

### Próximos pasos:

1. ▶️ Inicia el servidor: `php artisan serve`
2. 🌐 Abre: http://localhost:8000
3. 🔮 ¡Descubre tu signo zodiacal!
4. 🧪 Prueba los endpoints en: http://localhost:8000/tester.html

---

## 💡 PERSONALIZACIÓN FUTURA

Si deseas agregar más funcionalidades:

- Agregar base de datos real: Mira `database/` para migraciones
- Agregar autenticación: Usa Laravel Sanctum (ya incluido)
- Agregar cache: Configura en `.env`
- Agregar más signos: Edita `ZodiacService.php`

---

**¡Disfruta tu API de Signos Zodiacales! 🔮✨**

*Última actualización: Diciembre 2025*
