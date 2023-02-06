<?php

require '../../model/Process.php';

$id = 4;

$process = new Process();
$array_process = $process->get_one_process(4);

echo json_encode($array_process);

?>