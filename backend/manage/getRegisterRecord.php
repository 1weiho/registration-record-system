<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

$employee_ssn = $_SESSION['employee_ssn'];
$sql = "SELECT register_id, parent_name, phone_num, store_name FROM register_record NATURAL JOIN store_list WHERE store_uuid IN (SELECT store_uuid FROM store_list  NATURAL JOIN responsible_for WHERE employee_ssn = {$employee_ssn});";
$result = $model->execute($sql);
$count = count($result);
for ($i = 0; $i < $count; $i++) {
    $result[$i]['serial_num'] = $i + 1;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
