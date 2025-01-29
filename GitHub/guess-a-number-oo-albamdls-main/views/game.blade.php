@extends('main')

@section('titulo', '¡Juguemos!')
@section('contenido')

<form action="index.php" method="POST">
    <table>
        <td>
            <label for="intento">Introduce tu apuesta:</label>
        </td>
        <td>
            <input type="number" id="apuestaUsuario" name="apuestaUsuario">
        </td>
        <td>
            <button type="submit" value="intentar" name="intentar">Enviar</button>
        </td>
    </table>
</form>
<div>
    <p>{{$mensajePrincipal}}</p>
</div>

@endsection