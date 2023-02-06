<?php

require '../../model/Process.php';

$process = new Process();
$array_process = $process->get_all_processes();

echo json_encode($array_process);

?>