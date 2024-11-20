<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'ProStudy') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 2rem;
            color: #333333;
            margin-bottom: 1rem;
        }

        .description {
            color: #666666;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .button {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button-secondary {
            background-color: #6c757d;
        }

        .button-secondary:hover {
            background-color: #5a6268;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #888888;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao ProStudy</h1>
        <p class="description">Gerencie seus horários, tarefas e estudos de forma eficiente e organizada.</p>

        <div class="button-group">
            <!-- Botão de Login -->
            <a href="{{ route('login') }}" class="button">Login</a>

            <!-- Botão de Registro -->
            <a href="{{ route('register') }}" class="button button-secondary">Registrar-se</a>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} ProStudy. Todos os direitos reservados.</p>
            <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a></p>
        </div>
    </div>
</body>
</html>
