<?php

require '../../model/User.php';

$id = $_POST['id'];

$user = new User();
echo $user->destroy($id);

?>