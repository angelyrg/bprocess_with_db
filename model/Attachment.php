<?php

//Connect to databse
require "Conection.php";

class Attachment extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $result = $this->conexion_db->query('SELECT * FROM attached_files');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert_new(string $attach_name, string $attach_file, $file_type, $process_id)
    {
        $sql = "INSERT INTO attached_files (attach_name, attach_file, file_type, process_id) VALUES ('$attach_name', '$attach_file', $file_type, $process_id)";
        if ($this->conexion_db->query($sql) === TRUE) {
            return $this->conexion_db->insert_id;
        } else {
            return "error";
        }
    }

    public function get_attach_name($id){
        $result = $this->conexion_db->query("SELECT attach_file FROM attached_files WHERE id='$id' ");
        return $result->fetch_all(MYSQLI_ASSOC)[0]["attach_file"];
    }

    public function destroy($id)
    {
        $query = "DELETE FROM attached_files WHERE id = $id ";        
        if ($this->conexion_db->query($query) === TRUE) {
            return $id;
        } else {
            return "error";
        }
    }

}

?>