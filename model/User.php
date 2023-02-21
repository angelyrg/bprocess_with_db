<?php

//Connect to databse
require "Conection.php";

class User extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = $this->conexion_db->query('SELECT * FROM users');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function show($id)
    {
        $result = $this->conexion_db->query("SELECT * FROM users WHERE id = '$id' ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, string $username, string $role)
    {
        $sql = "UPDATE users SET username='$username', role='$role' WHERE id = $id ";
        if ($this->conexion_db->query($sql) === TRUE) {
            return $id;
        } else {
            return "error";
        }
    }


    public function store(string $username, string $password, string $role){

        $sql = "INSERT INTO users (username, password, role ) VALUES ( '$username', '$password', '$role') ";

        if ($this->conexion_db->query($sql) === TRUE) {
            return $this->conexion_db->insert_id;
        } else {
            return "error";
        }

    }

    public function destroy($id)
    {
        $query = "DELETE FROM users WHERE id = $id ";        
        if ($this->conexion_db->query($query) === TRUE) {
            return $id;
        } else {
            return "error";
        }
    }

    public function update_password($id, string $password)
    {
        $sql = "UPDATE users SET password='$password' WHERE id = $id ";
        if ($this->conexion_db->query($sql) === TRUE) {
            return $id;
        } else {
            return "error";
        }
    }


}

?>