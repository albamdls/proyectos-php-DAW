@extends('main')
@section('titulo','Configuración de parámetros')
@section('contenido')

<form action="index.php" method="POST">
    <table>
        <tr>
            <td><label for="minimo">Mínimo: </label></td>
            <td><input type="number" name="minimo" id="minimo" min="0" max="4" required></td>
        </tr>
        <tr>
            <td><label for="maximo">Máximo: </label></td>
            <td><input type="number" name="maximo" id="maximo" min="1" required ></td>
        </tr>
        <tr>
            <td><label for="maxIntentos">Intentos permitidos: </label></td>
            <td><input type="number" name="maxIntentos" id="maxIntentos" min="2" max="10" required ></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" value="ajustesJuego" name="ajustesJuego">Generar Juego</button>
            </td>
        </tr>
    </table>
</form>
<div>
    <!-- Este mensaje solo se mostrará en caso de que la variable errorForm no esté vacía -->
    @if (!empty($mensajeError))
        <p style="color: red;" >{{$mensajeError}}</p>
    @endif
</div>
@endsection