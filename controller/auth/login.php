<?php
require '../../model/Auth.php';

$auth = new Auth();

$username = $_POST['username'];
$password = $_POST['password'];

echo $auth->login($username, $password) ? "login" : "error";

?>