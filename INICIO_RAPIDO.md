# 🚀 Guía Rápida de Instalación - Zodiac Sign API

## Paso 1: Navegar a la carpeta del proyecto

```powershell
cd C:\xampp\htdocs\programas\zodiac-api
```

## Paso 2: Instalar dependencias (si no se hicieron)

```powershell
composer install
```

## Paso 3: Generar clave de aplicación (si no se hizo)

```powershell
php artisan key:generate
```

## Paso 4: Iniciar el servidor

### Opción A: Usando PHP artisan serve (Recomendado)

```powershell
php artisan serve
```

El servidor estará disponible en: **http://localhost:8000**

### Opción B: Usando XAMPP (Alternativo)

1. Coloca la carpeta en `C:\xampp\htdocs`
2. Accede a `http://localhost/zodiac-api/public`

## Paso 5: Acceder a la aplicación

- **Interfaz Web**: http://localhost:8000/zodiac
- **API**: http://localhost:8000/api/zodiac

## Primeros Pasos

### Desde la web:
1. Abre tu navegador en http://localhost:8000/zodiac
2. Selecciona tu fecha de nacimiento
3. ¡Descubre tu signo zodiacal!

### Desde la API:

Abre tu terminal y ejecuta:

```powershell
# Con Invoke-WebRequest (PowerShell)
$body = @{ birth_date = "1990-05-15" } | ConvertTo-Json
Invoke-WebRequest -Uri "http://localhost:8000/api/zodiac" `
  -Method POST `
  -ContentType "application/json" `
  -Body $body
```

O usa cualquier cliente HTTP como Postman, cURL o Insomnia.

## Detener el Servidor

Presiona `Ctrl + C` en la terminal

## Problemas Comunes

### ❌ Error: "composer not found"
**Solución**: Instala Composer desde https://getcomposer.org

### ❌ Error: "php not found"
**Solución**: Agrega PHP al PATH de Windows o usa XAMPP con su PHP

### ❌ Error de puerto 8000 ocupado
**Solución**: Especifica otro puerto:
```powershell
php artisan serve --port=8001
```

### ❌ Error 404 en rutas
**Solución**: Asegúrate de usar `http://localhost:8000` (no `localhost`)

## 📚 Documentación Completa

Abre el archivo `README_ZODIAC_API.md` para documentación completa

## 🧪 Archivos de Prueba

- `EJEMPLOS_USO.php` - Ejemplos de cómo usar los endpoints
- `README_ZODIAC_API.md` - Documentación completa de la API

## 💡 Próximos Pasos

1. Explora los diferentes endpoints de la API
2. Integra el servicio en tu aplicación
3. Personaliza según tus necesidades

---

¡Listo! Ya tienes tu servicio de signos zodiacales funcionando. 🎉
