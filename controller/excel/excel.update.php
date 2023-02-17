<?php
require '../../model/ExcelLink.php';

$excel_link = new ExcelLink();

$new_link = $_POST['excel_link'];

echo $excel_link->update_excel_link($new_link);
?>