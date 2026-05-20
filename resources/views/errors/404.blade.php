<?php
// Enviamos el encabezado HTTP correcto para un error 404
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Error</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/errorstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
</head>

<body>
    <div class="error-container">
        <h1 class="error-number">
            <span class="char animate-float-1">4</span>
            <span class="char animate-float-2">0</span>
            <span class="char animate-float-3">4</span>
        </h1>

        <p class="error-message animate-fade-in">
            sorry,<br>
            we cant find a page you’re looking for.
        </p>

        <a href="/" class="btn-back animate-fade-in">back home</a>
    </div>

</body>

</html>