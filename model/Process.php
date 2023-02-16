<?php

//Connect to databse
require "Conection.php";

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
        $attached[] = $query->fetch_all(MYSQLI_ASSOC);
        
        return array_map(null, $process, $attached);

    }

    public function update_process($id, string $name, bool $isDirectory, string $description="")
    {
        $icon = $isDirectory ? "folder" :  "textdocument";
        $sql = "UPDATE processes SET name='$name', description='$description', icon='$icon', isDirectory='$isDirectory' WHERE id = $id ";
        
        if ($this->conexion_db->query($sql) === TRUE) {
            return $id;
        } else {
            return "error";
        }
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

    public function update_main_file($id, string $file_name)
    {
        $sql = "UPDATE processes SET main_file='$file_name' WHERE id = $id";
        return ($this->conexion_db->query($sql) === TRUE) ? $id : "error";
    }

    public function update_bizagi_folder($id, string $bizagi_folder)
    {
        $sql = "UPDATE processes SET bizagi_folder='$bizagi_folder' WHERE id = $id";
        return ($this->conexion_db->query($sql) === TRUE) ? $id : "error";
    }

    public function insert_new_record(string $name, bool $isDirectory, $description="", $main_file="", $bizagi_folder=""){

        $icon = $isDirectory ? "folder" :  "textdocument";
        $sql = "INSERT INTO processes (parentId, name, description, main_file, bizagi_folder, icon, isDirectory) VALUES (NULL, '$name', '$description', '$main_file', '$bizagi_folder','$icon', '$isDirectory') ";

        if ($this->conexion_db->query($sql) === TRUE) {
            return $this->conexion_db->insert_id;
        } else {
            return "error";
        }

    }

    public function destroy($id)
    {
        // TO DO: Delete all children from the root
        $query = "DELETE FROM processes WHERE id = $id ";        
        if ($this->conexion_db->query($query) === TRUE) {
            return $id;
        } else {
            return "error";
        }
    }

    public function get_bizagi_folder_name($id){
        $result = $this->conexion_db->query("SELECT bizagi_folder FROM processes WHERE id='$id' ");
        return $result->fetch_all(MYSQLI_ASSOC)[0]["bizagi_folder"];
    }

    public function get_main_file_name($id){
        $result = $this->conexion_db->query("SELECT main_file FROM processes WHERE id='$id' ");
        return $result->fetch_all(MYSQLI_ASSOC)[0]["main_file"];
    }

    public function remove_pdf($id)
    {
        $sql = "UPDATE processes SET main_file='' WHERE id = $id";
        return ($this->conexion_db->query($sql) === TRUE) ? $id : "error";
    }

    public function remove_bizagi($id)
    {
        $sql = "UPDATE processes SET bizagi_folder='' WHERE id = $id";
        return ($this->conexion_db->query($sql) === TRUE) ? $id : "error";
    }

}

?>