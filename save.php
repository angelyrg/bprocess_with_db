<?php

$title = $_POST['title'];
$description = $_POST['description'];

$file = file_get_contents('data.json');
$data = json_decode($file, true);
unset($_POST["add"]);
$data["records"] = array_values($data["records"]);
array_push($data["records"], $_POST);
file_put_contents("data.json", json_encode($data));


?>