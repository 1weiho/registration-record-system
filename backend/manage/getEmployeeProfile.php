<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

$employee_ssn = $_SESSION['employee_ssn'];
$sql = $model->select("employee_list", ['employee_name']) . $model->where('employee_ssn', '=', $employee_ssn);
$result = $model->execute($sql);
$sql = $model->select("employee_account", ['employee_email']) . $model->where('employee_ssn', '=', $employee_ssn);
$result[0]['employee_email'] = $model->execute($sql)[0]['employee_email'];

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
