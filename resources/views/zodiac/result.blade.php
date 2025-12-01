<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Signo Zodiacal</title>
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
            max-width: 600px;
            width: 100%;
        }

        .error {
            background: #fee;
            border: 2px solid #fcc;
            border-radius: 10px;
            padding: 20px;
            color: #c00;
            text-align: center;
        }

        .error h2 {
            margin-bottom: 10px;
        }

        .success {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .symbol {
            font-size: 4em;
            margin-bottom: 15px;
        }

        .sign-name {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .date-range {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .info-card h3 {
            color: #667eea;
            font-size: 0.9em;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-card p {
            color: #333;
            font-size: 1.2em;
            font-weight: 600;
        }

        .description-box {
            background: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            line-height: 1.8;
            color: #555;
        }

        .description-box h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .compatible-signs {
            background: #f0f7ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .compatible-signs h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .signs-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .sign-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        button {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-back {
            background: #f0f0f0;
            color: #333;
        }

        .btn-back:hover {
            background: #e0e0e0;
        }

        .btn-api {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-api:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .message {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.1em;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .sign-name {
                font-size: 1.8em;
            }

            .symbol {
                font-size: 3em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if($result['success'])
            <div class="success">
                <div class="header">
                    <div class="symbol">{{ $result['symbol'] }}</div>
                    <div class="sign-name">{{ $result['zodiac_sign'] }}</div>
                    <div class="date-range">{{ $result['date_range'] }}</div>
                </div>

                <div class="message">
                    {{ $result['message'] }}
                </div>

                <div class="info-grid">
                    <div class="info-card">
                        <h3>Edad</h3>
                        <p>{{ $result['age'] }} años</p>
                    </div>
                    <div class="info-card">
                        <h3>Elemento</h3>
                        <p>{{ $result['element'] }}</p>
                    </div>
                </div>

                <div class="description-box">
                    <h3>📖 Descripción</h3>
                    <p>{{ $result['description'] }}</p>
                </div>

                @if(!empty($result['compatible_signs']))
                    <div class="compatible-signs">
                        <h3>💕 Signos Compatibles</h3>
                        <div class="signs-list">
                            @foreach($result['compatible_signs'] as $sign)
                                <span class="sign-badge">{{ $sign }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="button-group">
                    <form action="{{ route('zodiac.form') }}" style="width: 100%; display: flex; gap: 10px;">
                        <button type="submit" class="btn-back" style="flex: 1;">← Volver</button>
                    </form>
                </div>
            </div>
        @else
            <div class="error">
                <h2>⚠️ Error</h2>
                <p>{{ $result['error'] ?? 'Ha ocurrido un error al procesar tu solicitud.' }}</p>
                <div class="button-group" style="margin-top: 20px;">
                    <form action="{{ route('zodiac.form') }}" style="width: 100%;">
                        <button type="submit" class="btn-back" style="width: 100%;">← Volver</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
