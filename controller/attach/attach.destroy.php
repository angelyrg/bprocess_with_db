<?php
require '../../model/Attachment.php';
$att = new Attachment();

$attached_id = $_POST["attached_id"];
$attach_file = $att->get_attach_name($attached_id);

if(unlink('../../upload/attach/'.$attach_file)){
    echo $att->destroy($attached_id);
}else{
    echo "error";
}
