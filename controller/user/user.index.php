<?php

require '../../model/User.php';

$user = new User();
//Get all users from db
$all_users = $user->index();

echo json_encode($all_users);

?>