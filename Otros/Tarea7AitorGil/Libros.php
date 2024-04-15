<?php
class Libros
{
    /**
     * Conecta con la base de datos
     * @param string $servidor Dirección del servidor
     * @param string $bdd Nombre de la base de datos
     * @param string $usuario Usuario de la base de datos
     * @param string $contrasena Contraseña de la base de datos
     * @return mysqli|null Devuelve un objeto mysqli con la conexión o null si falla
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */
    public function conexion($servidor, $bbdd, $usuario, $contrasena)
    {
        try {
            $conectado = new mysqli($servidor, $usuario, $contrasena, $bbdd);

            if ($conectado->connect_errno) {
                exit("Conexión fallida: " . $conectado->connect_error);
                return null;
            } else {
                return $conectado;
            }
        } catch (mysqli_sql_exception $excepcion) {
            return null;
        }
    }

    /**
     * Consulta los datos de uno o varios autores
     * @param mysqli $conectar El objeto de conexión a la base de datos
     * @param int|null $id_autor El identificador del autor que se quiere consultar o null para consultar todos
     * @return string|object|null Un string con los nombres y apellidos de los autores, un objeto con los datos de un autor o null si falla la consulta
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */


    public function consultarAutores($conectar, $id_autor)
    {
        try {
            if ($id_autor == null) {
                $consulta = "SELECT * FROM autor";
                $resultado = $conectar->query($consulta);
                $filas = array(); 
                while ($objeto = $resultado->fetch_object()) { 
                    $filas[] = $objeto; 
                }
                return $filas;
                /*$filas = "";
                while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    $filas = $filas . $fila["nombre"] . " " . $fila["apellidos"] . "</br>";
                }

                return $filas;*/
            } else {
                $consulta = "SELECT * FROM autor WHERE id = '$id_autor'";
                $resultado = $conectar->query($consulta);
                $fila = $resultado->fetch_object();
                return $fila;
            }


        } catch (mysqli_sql_exception $excepcion) {
            return null;
        }

    }

    /**
     * Consulta los datos de uno o varios libros
     * @param mysqli $conectar El objeto de conexión a la base de datos
     * @param int|null $id_autor El identificador del autor cuyos libros se quieren consultar o null para consultar todos
     * @return string|array|null Un string con los datos de los libros, un array de objetos con los datos de los libros de un autor o null si falla la consulta
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */
    public function consultarLibros($conectar, $id_autor)
    {
        try {
            if ($id_autor == null) {
                $consulta = "SELECT * FROM libro";
                $resultado = $conectar->query($consulta);
                $filas = array(); 
                while ($objeto = $resultado->fetch_object()) { 
                    $filas[] = $objeto; 
                }
                return $filas;
                /*
                $filas = "";
                while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    $filas = $filas . $fila["id"] . " " . $fila["titulo"] . " " . $fila["f_publicacion"] . " " . $fila["id_autor"] . "</br>";
                }

                return $filas;*/
            } else {
                $consulta = "SELECT * FROM libro WHERE id_autor = '$id_autor'";
                $resultado = $conectar->query($consulta);
                $datos = array();
                while ($fila = $resultado->fetch_object()) {
                    $fila->f_publicacion = date('d/m/Y', strtotime($fila->f_publicacion));
                    $datos[] = $fila;

                }
                return $datos;
                /*$filas = "";
                while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    $filas = $filas . $fila["titulo"] . ", ";
                }

                return $filas;*/
            }
        } catch (mysqli_sql_exception $excepcion) {
            return null;
        }

    }

    /**
     * Consulta los datos de un libro
     * @param mysqli $conectar El objeto de conexión a la base de datos
     * @param int $id_libro El identificador del libro que se quiere consultar
     * @return object|null Un objeto con los datos del libro o null si falla la consulta
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */
    public function consultarDatosLibro($conectar, $id_libro)
    {
        try {
            $consulta = "SELECT * FROM libro WHERE id = $id_libro";
            $resultado = $conectar->query($consulta);
            $fila = $resultado->fetch_object();

            return $fila;
        } catch (mysqli_sql_exception $excepcion) {
            return null;
        }
    }

    /**
     * Borra un autor de la base de datos
     * @param mysqli $conectar El objeto de conexión a la base de datos
     * @param int $id_autor El identificador del autor que se quiere borrar
     * @return bool true si se borra el autor con éxito o false si falla
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */
    public function borrarAutor($conectar, $id_autor)
    {
        try {
            $consulta = "DELETE FROM autor WHERE id = $id_autor";
            $resultado = $conectar->query($consulta);

            if ($resultado == false) {
                return false;
            } else {
                return true;
            }
        } catch (mysqli_sql_exception $excepcion) {
            return false;
        }
    }

    /**
     * Borra un libro de una base de datos MySQL
     * @param mysqli $conectar Un objeto mysqli que representa la conexión a la base de datos
     * @param int $id_libro El identificador del libro que se quiere borrar
     * @return bool true si se borra el libro con éxito o false si falla
     * @throws mysqli_sql_exception Si ocurre un error al ejecutar la consulta
     */
    public function borrarLibro($conectar, $id_libro)
    {
        try {
            $consulta = "DELETE FROM libro WHERE id = '$id_libro'";
            $resultado = $conectar->query($consulta);

            if ($resultado == false) {
                return false;
            } else {
                return true;
            }
        } catch (mysqli_sql_exception $excepcion) {
            return false;
        }
    }


}

?>