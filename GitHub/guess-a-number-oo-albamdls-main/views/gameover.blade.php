@extends('main')
@section('titulo', 'Game Over')
@section('contenido')

<h1>Juego Terminado</h1>
<p>{{$mensajeFinal}}</p>
<br>
<a href="index.php">Jugar de Nuevo</a>

@endsection