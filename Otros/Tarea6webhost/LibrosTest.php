<?php declare(strict_types=1);
// LibrosTest.php

/*
 * Notas:
 * Actualizar las variables $servidor, $usuario, $contrasena y $basedatos en
 * de los requisitos y la configuración del alumno.
 */

require_once("modelo.php");
use PHPUnit\Framework\TestCase;

final class LibrosTest extends TestCase {
    
    private $servidor = 'localhost';
    private $usuario = 'id21731205_aitor';
    private $contrasena = 'Foc1234*';
    private $basedatos = 'id21731205_libros';
    
    public function testConexionOK(): void {
        $libros = new Libros();
        $resultado = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        $this -> assertNotNull($resultado);
    }

    public function testConexionKO(): void {
        $libros = new Libros();
        $resultado = $libros -> conexion($this->servidor, $this->basedatos, 'usuario_invalido', $this->contrasena);
        $this -> assertNull($resultado);
    }

    public function testConsultarAutores(): void {
        $esperado = new stdClass();
        $esperado -> id = "1";
        $esperado -> nombre = "Isaac";
        $esperado -> apellidos = "Asimov";
        $esperado -> nacionalidad = "Rusia";

        $libros = new Libros();
        $con = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        $resultado = $libros -> consultarAutores($con, 1);
        $this -> assertEquals($esperado, $resultado);
    }

    public function testConsultarLibros(): void {
        $obj = new stdClass();
        $obj -> id="4";
        $obj -> titulo="Un guijarro en el cielo";
        $obj -> f_publicacion="19/01/1950";
        $obj -> id_autor="1";
        $obj1 = new stdClass();
        $obj1 ->id="5";
        $obj1 -> titulo="Fundación";
        $obj1 -> f_publicacion="01/06/1951";
        $obj1 -> id_autor="1";
        $obj2 = new stdClass();
        $obj2 -> id="6";
        $obj2 -> titulo="Yo, robot";
        $obj2 -> f_publicacion="02/12/1950";
        $obj2 -> id_autor="1";
        $esperado = array($obj, $obj1, $obj2);

        $libros = new Libros();
        $con = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        $resultado = $libros -> consultarLibros($con, 1);
        $this -> assertEquals($esperado, $resultado);
    }

    public function testConsultarDatosLibro(): void {
        $esperado = new stdClass();
        $esperado -> id = '1';
        $esperado -> titulo = "La Comunidad del Anillo";
        $esperado -> f_publicacion = "1954-07-29";
        $esperado -> id_autor = "0";

        $libros = new Libros();
        $con = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        $resultado = $libros -> consultarDatosLibro($con, 1);
        $this -> assertEquals($esperado, $resultado);
    }

    public function testBorrarLibro(): void {
        $libros = new Libros();
        $con = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        //Borrar libro 2
        $resultado = $libros -> borrarLibro($con, 3);
        $this->assertEquals(true, $resultado);
        //Comprobar que el libro 2 ya no está
        $resultado = $libros -> consultarDatosLibro($con, 3);
        $this->assertNull($resultado);
    }

    public function testBorrarAutor(): void{
        $libros = new Libros();
        $con = $libros -> conexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        //Borrar autor 2
        $resultado = $libros -> borrarAutor($con, 1);
        $this -> assertEquals(true, $resultado);
        //Comprobar que el autor 2 ya no está
        $resultado = $libros -> consultarAutores($con, 1);
        $this -> assertNull($resultado);
        //Comprobar que el autor 2 ya no tiene libros
        $resultado = $libros -> consultarLibros($con, 1);
        $this -> assertEmpty($resultado);
    }
    
}

?>
