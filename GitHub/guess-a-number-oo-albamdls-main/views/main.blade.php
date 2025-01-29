<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
</head>
<body>
    <div class="paguina">
        <h1>Adivina el número</h1>
        <div class="container">
            @yield('contenido')
        </div>
    </div>
</body>
</html>