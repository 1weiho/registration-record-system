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
        $sql = $model->select('store_list', ['store_name', 'store_address']) . $model->where('store_id', '=', $store_id);
        $result = $model->execute($sql);
    } else {
        $result = false;
    }
} else {
    $result = false;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
