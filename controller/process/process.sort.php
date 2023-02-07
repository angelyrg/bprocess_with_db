<?php

require '../../model/Process.php';

$id = $_POST['idfrom'];
$idto = $_POST['idto'];

$process = new Process();
$result = $process->update_parent_id($id, $idto);

echo $result;

?>