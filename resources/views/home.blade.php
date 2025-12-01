<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔮 Zodiac Sign API - Servicio Web de Signos Zodiacales</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo {
            font-size: 1.5em;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 60px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header .symbol {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 3em;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }

        .header p {
            font-size: 1.3em;
            color: #666;
            margin-bottom: 30px;
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1em;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .card-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .card a:hover {
            gap: 10px;
        }

        .features {
            background: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .features h2 {
            color: #667eea;
            margin-bottom: 30px;
            font-size: 2em;
            text-align: center;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .feature-item {
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 10px;
            text-align: center;
        }

        .feature-item h4 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .feature-item p {
            color: #555;
            font-size: 0.95em;
        }

        .api-docs {
            background: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .api-docs h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .code-block {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            margin-bottom: 20px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }

        .code-block pre {
            margin: 0;
        }

        .endpoint {
            background: #f5f5f5;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .endpoint .method {
            display: inline-block;
            padding: 3px 8px;
            background: #667eea;
            color: white;
            border-radius: 3px;
            font-weight: bold;
            font-size: 0.85em;
        }

        .endpoint .path {
            color: #667eea;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        .zodiac-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .zodiac-item {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            color: white;
            padding: 30px;
            font-size: 0.95em;
        }

        .footer a {
            color: white;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header {
                padding: 40px;
            }

            .header h1 {
                font-size: 2em;
            }

            .header .symbol {
                font-size: 2.5em;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .navbar {
                flex-direction: column;
                align-items: center;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">🔮 Zodiac Sign API</div>
        <ul class="nav-links">
            <li><a href="#caracteristicas">Características</a></li>
            <li><a href="#api">API</a></li>
            <li><a href="/zodiac">Web App</a></li>
            <li><a href="/tester.html">Probador API</a></li>
        </ul>
    </div>

    <div class="container">
        <!-- Header Principal -->
        <div class="header">
            <div class="symbol">♈ ♉ ♊ ♋ ♌ ♍ ♎ ♏ ♐ ♑ ♒ ♓</div>
            <h1>Zodiac Sign API</h1>
            <p>🌟 Servicio Web para Descubrir tu Signo Zodiacal</p>
            <p style="font-size: 0.95em; color: #999; margin-bottom: 0;">
                Determina tu signo zodiacal según tu fecha de nacimiento con descripciones detalladas y compatibilidades
            </p>
            
            <div class="cta-buttons">
                <a href="/zodiac" class="btn btn-primary">🔮 Descubrir Mi Signo</a>
                <a href="#api" class="btn btn-secondary">📚 Ver API</a>
                <a href="/tester.html" class="btn btn-secondary">🧪 Probar API</a>
            </div>
        </div>

        <!-- Características -->
        <div class="features" id="caracteristicas">
            <h2>✨ Características Principales</h2>
            <div class="feature-list">
                <div class="feature-item">
                    <h4>🎯 Detección Precisa</h4>
                    <p>Calcula exactamente tu signo zodiacal</p>
                </div>
                <div class="feature-item">
                    <h4>📊 Información Completa</h4>
                    <p>Descripciones detalladas de cada signo</p>
                </div>
                <div class="feature-item">
                    <h4>💕 Compatibilidad</h4>
                    <p>Verifica compatibilidad entre signos</p>
                </div>
                <div class="feature-item">
                    <h4>🌐 API RESTful</h4>
                    <p>Endpoints JSON para integración</p>
                </div>
                <div class="feature-item">
                    <h4>📱 Responsivo</h4>
                    <p>Funciona en todos los dispositivos</p>
                </div>
                <div class="feature-item">
                    <h4>⚡ Sin Base de Datos</h4>
                    <p>Datos temporales en memoria</p>
                </div>
            </div>
        </div>

        <!-- Cards de Acciones -->
        <div class="content">
            <div class="card">
                <div class="card-icon">🔮</div>
                <h3>Aplicación Web</h3>
                <p>Interfaz intuitiva para descubrir tu signo zodiacal ingresando tu fecha de nacimiento.</p>
                <a href="/zodiac">Acceder →</a>
            </div>

            <div class="card">
                <div class="card-icon">🧪</div>
                <h3>Probador de API</h3>
                <p>Herramienta interactiva para probar todos los endpoints de la API en tiempo real.</p>
                <a href="/tester.html">Abrir Probador →</a>
            </div>

            <div class="card">
                <div class="card-icon">📚</div>
                <h3>Documentación</h3>
                <p>Guía completa con ejemplos de uso en cURL, JavaScript, Python y más lenguajes.</p>
                <a href="#api">Leer Documentación →</a>
            </div>
        </div>

        <!-- Documentación API -->
        <div class="api-docs" id="api">
            <h2>📚 Documentación de la API</h2>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">1️⃣ Obtener Signo Zodiacal por Fecha</h3>
            <div class="endpoint">
                <div><span class="method">POST</span> <span class="path">/api/zodiac</span></div>
            </div>
            <p><strong>Parámetro:</strong> birth_date (YYYY-MM-DD, DD-MM-YYYY, etc.)</p>
            <div class="code-block"><pre>{
  "success": true,
  "birth_date": "1995-05-15",
  "age": 29,
  "zodiac_sign": "Tauro",
  "symbol": "♉",
  "date_range": "20 de abril - 20 de mayo",
  "element": "Tierra",
  "compatible_signs": ["Virgo", "Capricornio", "Cáncer", "Piscis"]
}</pre></div>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">2️⃣ Obtener Todos los Signos</h3>
            <div class="endpoint">
                <div><span class="method">GET</span> <span class="path">/api/zodiac/signs</span></div>
            </div>
            <p>Devuelve lista completa de los 12 signos zodiacales con toda su información.</p>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">3️⃣ Obtener Signo por Nombre</h3>
            <div class="endpoint">
                <div><span class="method">GET</span> <span class="path">/api/zodiac/signs/{nombre}</span></div>
            </div>
            <p><strong>Ejemplo:</strong> GET /api/zodiac/signs/Tauro</p>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">4️⃣ Verificar Compatibilidad</h3>
            <div class="endpoint">
                <div><span class="method">POST</span> <span class="path">/api/zodiac/compatibility</span></div>
            </div>
            <p><strong>Parámetros:</strong> sign1, sign2</p>
            <div class="code-block"><pre">
Ejemplo Request:
{
  "sign1": "Tauro",
  "sign2": "Virgo"
}

Ejemplo Response:
{
  "success": true,
  "sign1": "Tauro",
  "sign2": "Virgo",
  "compatibility": "Compatible",
  "percentage": 85,
  "message": "..."
}</pre></div>

            <h3 style="color: #667eea; margin: 30px 0 15px 0; margin-top: 40px;">🔗 URL Base:</h3>
            <div class="code-block">http://localhost:8000/api</div>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">💻 Ejemplo con cURL:</h3>
            <div class="code-block"><pre>curl -X POST http://localhost:8000/api/zodiac \
  -H "Content-Type: application/json" \
  -d '{"birth_date":"1995-05-15"}'</pre></div>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">🐍 Ejemplo con Python:</h3>
            <div class="code-block"><pre>import requests

response = requests.post('http://localhost:8000/api/zodiac', 
  json={'birth_date': '1995-05-15'})
print(response.json())</pre></div>

            <h3 style="color: #667eea; margin: 30px 0 15px 0;">🔤 Ejemplo con JavaScript:</h3>
            <div class="code-block"><pre>fetch('http://localhost:8000/api/zodiac', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({birth_date: '1995-05-15'})
})
.then(r => r.json())
.then(data => console.log(data))</pre></div>
        </div>

        <!-- Signos Zodiacales -->
        <div class="features" style="margin-bottom: 40px;">
            <h2>12 Signos Zodiacales</h2>
            <div class="zodiac-grid">
                <div class="zodiac-item">♈ Aries</div>
                <div class="zodiac-item">♉ Tauro</div>
                <div class="zodiac-item">♊ Géminis</div>
                <div class="zodiac-item">♋ Cáncer</div>
                <div class="zodiac-item">♌ León</div>
                <div class="zodiac-item">♍ Virgo</div>
                <div class="zodiac-item">♎ Libra</div>
                <div class="zodiac-item">♏ Escorpio</div>
                <div class="zodiac-item">♐ Sagitario</div>
                <div class="zodiac-item">♑ Capricornio</div>
                <div class="zodiac-item">♒ Acuario</div>
                <div class="zodiac-item">♓ Piscis</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>🔮 Zodiac Sign API - Servicio Web de Signos Zodiacales</p>
            <p style="font-size: 0.85em; margin-top: 10px;">Desarrollado con ❤️ usando Laravel | Datos temporales (sin base de datos)</p>
            <p style="font-size: 0.85em; margin-top: 10px;">© 2025 - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
