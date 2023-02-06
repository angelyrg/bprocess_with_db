<?php

//nos conectamos a la base de datos
require "Conection.php";
/*Aquí vemos el primer ejemplo de herencia donde la clase Devuelve Productos utiliza
  aquellas variables y métodos definidas en el archivo conexión php y que estas sean
   accesibles es decir dependiendo de los modificadores de acceso que esta tenga  */

class Process extends Conexion
{

    public function __construct()
    {
        /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
        la clase conexión y el código extra que agreguemos en esta función que lo hereda*/

        parent::__construct();
    }


    public function get_all_processes()
    {
        /*Podemos usar la variable conexion_db gracias a la herencia */

        $result = $this->conexion_db->query('SELECT * FROM processes');
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function get_one_process($id)
    {
        $result = $this->conexion_db->query("SELECT * FROM processes WHERE id = '$id' ");
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function update_parent_id($id, $idTo)
    {
        //TO DO: Get $idTO value as null
        if ($idTo == 0){
            $sql = "UPDATE processes SET parentId = null WHERE id = $id ";
        }else{
            $sql = "UPDATE processes SET parentId = $idTo WHERE id = $id ";
        }

        $result = $this->conexion_db->query($sql);
        return $result;
    }
    

}

?>