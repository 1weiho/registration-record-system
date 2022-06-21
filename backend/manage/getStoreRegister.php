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
        $result["data"] = $model->execute($sql);
        $count = count($result["data"]);
        $result["register_count"] = $count;
        for ($i = 0; $i < $count; $i++) {
            $result["data"][$i]['serial_num'] = $i + 1;
        }
        $sql = $model->select("store_account", ["create_date"]) . $model->where("store_id", "=", $store_id);
        $create_date = $model->execute($sql)[0]["create_date"];
        $daydiff = floor((abs(strtotime(date("Y-m-d")) - strtotime($create_date)) / (60 * 60 * 24))) + 1;
        $average_count = round(($count / $daydiff), 2);
        $result["average_count"] = $average_count;
    } else {
        $result = false;
    }
} else {
    $result = false;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
