<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubre Tu Signo Zodiacal</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px;
            max-width: 500px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: #666;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        input[type="date"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        input[type="date"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .info-box {
            background: #f5f5f5;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            font-size: 0.95em;
            color: #555;
        }

        .info-box strong {
            color: #333;
        }

        .api-links {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e0e0e0;
            text-align: center;
        }

        .api-links h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.1em;
        }

        .api-link {
            display: inline-block;
            background: #f0f0f0;
            color: #667eea;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            font-size: 0.9em;
            transition: all 0.3s;
        }

        .api-link:hover {
            background: #667eea;
            color: white;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px;
            }

            .header h1 {
                font-size: 2em;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>♈ Zodiac Sign ♈</h1>
            <p>Descubre tu signo zodiacal</p>
        </div>

        <div class="info-box">
            <strong>ℹ️ Instrucciones:</strong> Ingresa tu fecha de nacimiento para descubrir tu signo zodiacal y obtener información detallada sobre él.
        </div>

        <form method="POST" action="{{ route('zodiac.result') }}">
            @csrf
            <div class="form-group">
                <label for="birth_date">📅 Fecha de Nacimiento:</label>
                <input 
                    type="date" 
                    id="birth_date" 
                    name="birth_date" 
                    required
                    max="{{ date('Y-m-d') }}"
                >
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Descubrir Mi Signo</button>
            </div>
        </form>

        <div class="api-links">
            <h3>API Endpoints</h3>
            <a href="http://{{ request()->host() }}/api/zodiac/signs" class="api-link" target="_blank">Ver Todos los Signos</a>
        </div>
    </div>
</body>
</html>
