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
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_one_process($id)
    {
        $query = $this->conexion_db->query("SELECT * FROM processes WHERE id = '$id' ");
        $process = $query->fetch_all(MYSQLI_ASSOC);
        
        $query = $this->conexion_db->query("SELECT * FROM attached_files WHERE process_id = '$id' ");
        $attached = $query->fetch_all(MYSQLI_ASSOC);

        $data = array_map(null, $process, $attached);

        return ($data);

    }

    public function update_parent_id($id, $idTo)
    {
        //TO DO: Get $idTO value as null
        if ($idTo == 0){
            $sql = "UPDATE processes SET parentId = NULL WHERE id = $id ";
        }else{
            $sql = "UPDATE processes SET parentId = $idTo WHERE id = $id ";
        }

        return $this->conexion_db->query($sql);
    }

    public function insert_new_record(string $name, bool $isDirectory, $main_file="", $bizagi_folder=""){

        $icon = $isDirectory ? "activefolder" :  "file";

        $sql = "INSERT INTO processes (parentId, name, main_file, bizagi_folder, icon, isDirectory, expanded) VALUES (NULL, '$name', '$main_file', '$bizagi_folder','$icon', '$isDirectory', FALSE ) ";

        return $this->conexion_db->query($sql);
    }
    

}

?>