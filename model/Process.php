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
        $attached = $query->fetch_all(MYSQLI_ASSOC);
        
        return array_map(null, $process, $attached);

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

    public function update_process($id, string $name, bool $isDirectory)
    {
        $icon = $isDirectory ? "folder" :  "textdocument";
        $sql = "UPDATE processes SET name='$name', icon='$icon', isDirectory='$isDirectory' WHERE id = $id ";
        
        if ($this->conexion_db->query($sql) === TRUE) {
            echo $id;
        } else {
            echo "error";
        }
    }

    public function insert_new_record(string $name, bool $isDirectory, $main_file="", $bizagi_folder=""){

        $icon = $isDirectory ? "folder" :  "textdocument";
        $sql = "INSERT INTO processes (parentId, name, main_file, bizagi_folder, icon, isDirectory) VALUES (NULL, '$name', '$main_file', '$bizagi_folder','$icon', '$isDirectory') ";

        if ($this->conexion_db->query($sql) === TRUE) {
            echo $this->conexion_db->insert_id;
        } else {
            echo "error";
        }

    }

    public function destroy_level($id)
    {
        // TO DO: Delete all children from the root
        /*
        //Delete parent
        $sql = "DELETE FROM processes WHERE id = $id ";
        $children = [];

        $flag = true;
        while ($flag){
            $temp_children = $this->searchChildren($id);

            if ( count($temp_children) > 0 ){
                foreach($temp_children as $children_id){
                    array_push($children, $children_id);
                }
            }else{
                $flag = false;
                break;
            }
        }

        return $children;
        */
    }

    public function searchChildren($id){
        $query = $this->conexion_db->query(" SELECT id FROM processes WHERE parentId=$id ");
        return $query->fetch_all(MYSQLI_ASSOC);
    }


    

}

?>