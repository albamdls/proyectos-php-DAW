<?php

session_start();
require "vendor/autoload.php";

use eftec\bladeone\BladeOne;

class Juego
{
    // Atributos del objeto Juego
    private $minimo;
    private $maximo;
    private $maxIntentos; // Total de intentos máximos que indica el usuario
    private $totalIntentos; // Intentos que se van acumulando si no se acierta
    private $apuestaUsuario; // Numero que introduce el usuario
    private $numAleatorio; // Número secreto

    // Constructor del objeto Juego
    public function __construct($min, $max, $maxInt)
    {
        $this->minimo = $min;
        $this->maximo = $max;
        $this->maxIntentos = $maxInt;
        $this->totalIntentos = 0;
        $this->apuestaUsuario = null;
        $this->numAleatorio = rand($min, $max);
    }

    // Getter y Setters

    public function get_totalIntentos()
    {
        return $this->totalIntentos;
    }

    public function get_maxIntentos()
    {
        return $this->maxIntentos;
    }

    public function get_maximo()
    {
        return $this->maximo;
    }

    public function get_minimo()
    {
        return $this->minimo;
    }

    public function get_apuestaUsuario()
    {
        return $this->apuestaUsuario;
    }

    public function get_numAleatorio()
    {
        return $this->numAleatorio;
    }

    public function set_totalIntentos()
    {
        $this->totalIntentos++;
    }

    public function set_apuestaUsuario($apuestaUsuario)
    {
        $this->apuestaUsuario = $apuestaUsuario;
    }

    // Métodos

    public function darPista()
    {
        if ($this->get_apuestaUsuario() >= $this->get_numAleatorio()) {
            return "El número secreto es menor al número que has introducido.";
        } else if ($this->get_apuestaUsuario() <= $this->get_numAleatorio()) {
            return "El número secreto es mayor al número que has introducido.";
        }
    }

    public function comprobarIntento()
    {
        return ($this->get_apuestaUsuario() == $this->get_numAleatorio());
    }

    public function comprobarDerrota()
    {
        return ($this->get_apuestaUsuario() >= $this->maxIntentos);
    }
}

// AQUÍ TERMINA EL MODELO Y AHORA EMPEZARÍA EL CONTROLADOR QUE ES DONDE ESTÁ TODA LA LÓGICA DEL JUEGO

$blade = new BladeOne(__DIR__ . '/views', __DIR__ . '/cache', BladeOne::MODE_AUTO);

if (empty($_POST)) { // Si $_POST está vacío // no se accede correctamente
    echo $blade->run('form');
    exit;
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['minimo']) && isset($_POST['maximo']) && isset($_POST['maxIntentos'])) {
            $_SESSION['minimo'] = intval($_POST['minimo']);
            $_SESSION['maximo'] = intval($_POST['maximo']);
            $_SESSION['maxIntentos'] = intval($_POST['maxIntentos']);
        }

        if ($_SESSION['minimo'] >= $_SESSION['maximo']) {
            $mensajeError = "ERROR -> El minimo no puede ser más alto que el máximo.";
            echo $blade->run('form', ['mensajeError' => $mensajeError]);
            exit;
        } else if (isset($_POST['ajustesJuego']) && !isset($_POST['intentar'])) {
            $_SESSION['nuevoJuego'] = new Juego($_SESSION['minimo'], $_SESSION['maximo'], $_SESSION['maxIntentos']);
            echo $blade->run('game');
        } else if (isset($_POST['intentar'])) {

            $_SESSION['nuevoJuego']->set_apuestaUsuario(intval($_POST['apuestaUsuario']));
            $_SESSION['nuevoJuego']->set_totalIntentos();

            if ($_SESSION['nuevoJuego']->comprobarIntento()) {
                session_destroy();
                $mensajeFinal = "Enhorabuena!!! Has encontrado el número secreto!!!";
                echo $blade->run('gameover', ['mensajeFinal' => $mensajeFinal]);
                exit;
            } else if ($_SESSION['nuevoJuego']->comprobarDerrota()) {
                session_destroy();
                $mensajeFinal = "Lo siento, has perdido!! (-.-) . Vuelve a intentarlo!! L(o.o)L";
                echo $blade->run('gameover', ['mensajeFinal' => $mensajeFinal]);
                exit;
            }

            $mensaje = $_SESSION['nuevoJuego']->darPista();
            echo $blade->run('game', ['mensajePrincipal' => $mensaje]);
            exit;
        }
    }
}
