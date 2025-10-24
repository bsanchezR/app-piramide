<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Generador de Piramides Numéricas</title>
        <style>
            body {
                font-family: 'Courier New', monospace;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h1 {
                color: #333;
                text-align: center;
                margin-bottom: 30px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            input[type="number"] {
                width: 100px;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            button {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
            .piramide-output {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
                margin-top: 20px;
                white-space: pre;
                font-family: 'Courier New', monospace;
                font-size: 14px;
                line-height: 1.2;
                overflow-x: auto;
            }
            .info-box {
                background-color: #e7f3ff;
                border-left: 4px solid #007bff;
                padding: 15px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Genera una Piramide</h1>
            <div class="info-box">
                <strong>Instrucciones:</strong> Ingresa un Numero entre 1 y 9 para generar una Piramide.
                Puedes ajustar el Numero de filas (1-20).
            </div>
            <form method="POST" action="{{ route('piramide.genera') }}">
                @csrf
                <div class="form-group">
                    <label for="numero">Numero base (1-9):</label>
                    <input type="number" id="numero" name="numero" 
                        min="1" max="9" value="{{ old('numero', $numBase ?? 1) }}" required>
                    @error('numero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="filas">Numero de filas (1-20):</label>
                    <input type="number" id="filas" name="filas" 
                        min="1" max="20" value="{{ old('filas', $filas ?? 10) }}">
                    @error('filas')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">Generar Piramide</button>
            </form>
            @if(isset($piramide))
                <div class="form-group">
                    <h3>Piramide generada con el Numero: {{ $numBase }}</h3>
                    <div class="piramide-output">{{ $piramide }}</div>
                </div>
            @endif
        </div>
    </body>
</html>