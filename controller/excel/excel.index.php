<?php
require '../../model/ExcelLink.php';

$excel_link = new ExcelLink();
echo $excel_link->get_excel_link();
?>