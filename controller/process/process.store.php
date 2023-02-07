<?php
require '../../model/Process.php';

$is_directory = $_POST['is_directory'] == "1" ? true : ( $_POST['is_directory'] == "0" ? false : "" );
$item_name = $_POST['item_name'];

$process = new Process();
echo $process->insert_new_record($item_name, $is_directory );

?>