<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

if (isset($_POST["store_id"])) {
    $employee_ssn = $_SESSION['employee_ssn'];
    $store_id = $_POST['store_id'];
    $sql = "SELECT * FROM store_list WHERE store_id IN (SELECT store_id FROM responsible_for WHERE employee_ssn = {$employee_ssn}) AND store_id = {$store_id};";
    $checkIdentity = $model->execute($sql);
    if ($checkIdentity) {
        $sql = "SELECT register_id, parent_name, phone_num, register_time FROM register_record NATURAL JOIN store_list WHERE store_id = {$store_id};";
        $result = $model->execute($sql);
        $count = count($result);
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['serial_num'] = $i + 1;
        }
    } else {
        $result = false;
    }
} else {
    $result = false;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
