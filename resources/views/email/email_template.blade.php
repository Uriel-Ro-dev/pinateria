<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f9f0ff; /* Un lila muy suave de fondo */
            color: #444;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 20px; /* Más redondeado como tu logo */
            border: 2px solid #e9d5ff;
            overflow: hidden;
        }
        .header {
            background-color: #8c43f6; /* El morado de tu marca */
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 10px 0 0 0;
        }
        .logo-img {
            max-width: 80px;
            border-radius: 50%;
            border: 3px solid white;
        }
        .content {
            padding: 40px;
            text-align: center;
            line-height: 1.8;
        }
        .button {
            display: inline-block;
            background-color: #f643a7; /* Rosa fuerte para resaltar */
            color: #ffffff !important;
            padding: 14px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            background-color: #f3f4f6;
            color: #888;
            font-size: 12px;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://tu-dominio.com/img/logo.png" alt="Logo" class="logo-img">
            <h1>Piñatería Piña</h1>
        </div>

        <div class="content">
            <p style="font-size: 18px; font-weight: bold;">¡Hola!</p>
            <p>{{ $mensaje }}</p>

            <a href="{{ url('/') }}" class="button">Visitar Catálogo</a>
        </div>

        <div class="footer">
            <p>Hecho con ❤️ en Zapopan, Jalisco.</p>
            <small>© 2026 Piñatería Piña. Todos los derechos reservados.<br>
            Este es un sistema de pruebas de la UTJ.</small>
        </div>
    </div>
</body>
</html>
