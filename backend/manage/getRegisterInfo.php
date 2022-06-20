<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

$employee_ssn = $_SESSION['employee_ssn'];
if (isset($_POST["register_id"])) {
    $register_id = $_POST["register_id"];
    $sql = "SELECT parent_name, phone_num, register_time, store_name, store_address, promo_code FROM register_record NATURAL JOIN store_list WHERE store_uuid IN (SELECT store_uuid FROM store_list  NATURAL JOIN responsible_for WHERE employee_ssn = {$employee_ssn}) AND register_id = {$register_id};";
    $result = $model->execute($sql);
    if (!$result) {
        $result = false;
    }
} else {
    $result = false;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
