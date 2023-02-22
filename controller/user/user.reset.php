<?php

require '../../model/User.php';

$id = $_POST['id'];
$default_password = "12345678";
$new_password = password_hash($default_password, PASSWORD_DEFAULT);

$user = new User();
echo $user->update_password($id, $new_password);

?>