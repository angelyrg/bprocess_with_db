<?php
require '../../model/User.php';

$username = $_POST['new_username'];
$password = $_POST['user_password'];
$role = $_POST['user_role'];

$new_password = password_hash($password, PASSWORD_DEFAULT);

$user = new User();
echo $user->store($username, $new_password, $role);

?>