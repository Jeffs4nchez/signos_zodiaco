<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiac API - Signos Zodiacales</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
        }
        
        .header {
            text-align: center;
            color: #00ffff;
            margin-bottom: 50px;
        }
        
        .header h1 {
            font-size: 3.5rem;
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            font-weight: 700;
        }
        
        .header p {
            font-size: 1.3rem;
            color: #e0e0e0;
            opacity: 0.95;
        }
        
        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .card {
            background: #0f3460;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
            border: 2px solid #00ffff;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 255, 255, 0.2);
        }
        
        .card h2 {
            color: #00ffff;
            margin-bottom: 15px;
            font-size: 1.8rem;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }
        
        .card p {
            color: #e0e0e0;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #00ffff 0%, #00cccc 100%);
            color: #1a1a2e;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        
        .btn-secondary {
            background: #00ffff;
            color: #1a1a2e;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature {
            padding: 20px;
            background: rgba(0, 255, 255, 0.05);
            border-radius: 10px;
            color: #e0e0e0;
            text-align: center;
            border: 1px solid #00ffff;
        }
        
        .feature h3 {
            margin-bottom: 10px;
            color: #00ffff;
            font-size: 1.1rem;
        }
        
        .feature p {
            color: #c0c0c0;
            font-size: 0.95rem;
        }
        
        .zodiac-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .zodiac-item {
            padding: 15px;
            background: linear-gradient(135deg, #0f5f7f 0%, #0a4d63 100%);
            color: #00ffff;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid #00ffff;
        }
        
        .zodiac-item:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #00ffff 0%, #00cccc 100%);
            color: #1a1a2e;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        
        .zodiac-item .symbol {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .full-width {
            grid-column: 1 / -1;
        }
        
        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✨ Zodiac API ✨</h1>
            <p>Descubre tu signo zodiacal y compatibilidades</p>
        </div>
        
        <div class="content">
            <div class="card">
                <h2>🔮 Mi Signo</h2>
                <p>Ingresa tu fecha de nacimiento y descubre tu signo zodiacal completo con descripción, elemento y compatibilidades.</p>
                <form id="zodiacForm">
                    <div style="margin-bottom: 15px;">
                        <label for="birthDate" style="display: block; color: #00ffff; margin-bottom: 8px; font-weight: 600;">Fecha de Nacimiento:</label>
                        <input type="date" id="birthDate" name="birth_date" required style="width: 100%; padding: 12px; border: 2px solid #00ffff; border-radius: 5px; background: #1a1a2e; color: #00ffff; font-size: 1rem;">
                    </div>
                    <button type="submit" class="btn" style="width: 100%;">Descubrir Signo</button>
                </form>
                <div id="result" style="margin-top: 20px; display: none;">
                    <div id="resultContent"></div>
                </div>
            </div>
            
            <div class="card">
                <h2>📚 API Endpoints</h2>
                <p>Accede a nuestra API REST para obtener información sobre los signos zodiacales:</p>
                <ul style="margin-left: 20px; color: #e0e0e0; line-height: 2;">
                    <li><code style="background: #1a1a2e; color: #00ffff; padding: 5px 8px; border-radius: 3px; border-left: 3px solid #00ffff;">GET /api/zodiac/signs</code></li>
                    <li><code style="background: #1a1a2e; color: #00ffff; padding: 5px 8px; border-radius: 3px; border-left: 3px solid #00ffff;">GET /api/zodiac/signs/{name}</code></li>
                    <li><code style="background: #1a1a2e; color: #00ffff; padding: 5px 8px; border-radius: 3px; border-left: 3px solid #00ffff;">POST /api/zodiac</code></li>
                    <li><code style="background: #1a1a2e; color: #00ffff; padding: 5px 8px; border-radius: 3px; border-left: 3px solid #00ffff;">POST /api/zodiac/compatibility</code></li>
                </ul>
                <a href="#" onclick="testAPI()" class="btn" style="margin-top: 15px;">Probar API</a>
            </div>
            
            <div class="card full-width">
                <h2>🌟 Los 12 Signos Zodiacales</h2>
                <div class="zodiac-grid" id="signsGrid">
                    <div class="zodiac-item">
                        <div class="symbol">♈</div>
                        <div>Aries</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♉</div>
                        <div>Tauro</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♊</div>
                        <div>Géminis</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♋</div>
                        <div>Cáncer</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♌</div>
                        <div>León</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♍</div>
                        <div>Virgo</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♎</div>
                        <div>Libra</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♏</div>
                        <div>Escorpio</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♐</div>
                        <div>Sagitario</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♑</div>
                        <div>Capricornio</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♒</div>
                        <div>Acuario</div>
                    </div>
                    <div class="zodiac-item">
                        <div class="symbol">♓</div>
                        <div>Piscis</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="background: rgba(0, 255, 255, 0.05); border-radius: 15px; padding: 30px; color: #e0e0e0; border: 2px solid #00ffff;">
            <h2 style="margin-bottom: 20px; color: #00ffff; text-shadow: 0 0 10px rgba(0, 255, 255, 0.3);">✨ Características de la API</h2>
            <div class="features">
                <div class="feature">
                    <h3>12 Signos</h3>
                    <p>Información completa de todos los signos zodiacales</p>
                </div>
                <div class="feature">
                    <h3>Compatibilidad</h3>
                    <p>Descubre la compatibilidad entre dos signos</p>
                </div>
                <div class="feature">
                    <h3>Descripción Detallada</h3>
                    <p>Características, elementos y rasgos de cada signo</p>
                </div>
                <div class="feature">
                    <h3>API REST</h3>
                    <p>Acceso completo a través de endpoints RESTful</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('zodiacForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const birthDate = document.getElementById('birthDate').value;
            
            try {
                const response = await fetch('/api/zodiac', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ birth_date: birthDate })
                });
                
                const responseData = await response.json();
                const resultDiv = document.getElementById('result');
                const resultContent = document.getElementById('resultContent');
                
                // Acceder al objeto data dentro de la respuesta
                const data = responseData.data || responseData;
                
                if (responseData.success && data) {
                    resultContent.innerHTML = `
                        <div style="background: linear-gradient(135deg, #0a4d63 0%, #0f5f7f 100%); color: #00ffff; padding: 25px; border-radius: 10px; border: 2px solid #00ffff; box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);">
                            <h3 style="font-size: 1.8rem; margin-bottom: 15px; text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);">${data.zodiac_sign} ${data.symbol}</h3>
                            <p style="color: #e0e0e0; margin-bottom: 8px;"><strong style="color: #00ffff;">Rango de fechas:</strong> ${data.date_range}</p>
                            <p style="color: #e0e0e0; margin-bottom: 8px;"><strong style="color: #00ffff;">Elemento:</strong> ${data.element}</p>
                            <p style="color: #e0e0e0; margin-bottom: 15px;"><strong style="color: #00ffff;">Compatible con:</strong> ${Array.isArray(data.compatible_signs) ? data.compatible_signs.join(', ') : data.compatible_signs}</p>
                            <p style="margin-top: 15px; line-height: 1.8; color: #c0c0c0;">${data.description}</p>
                        </div>
                    `;
                } else {
                    resultContent.innerHTML = `<p style="color: #ff6b6b; font-weight: bold;">Error: ${responseData.message || 'Error desconocido'}</p>`;
                }
                
                resultDiv.style.display = 'block';
            } catch (error) {
                alert('Error al consultar la API: ' + error.message);
            }
        });
        
        function testAPI() {
            fetch('/api/zodiac/signs')
                .then(response => response.json())
                .then(data => {
                    alert(`API funcionando correctamente!\nTotal de signos: ${data.count}`);
                })
                .catch(error => alert('Error: ' + error.message));
        }
    </script>
</body>
</html>
