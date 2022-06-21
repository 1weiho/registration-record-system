<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

$employee_ssn = $_SESSION['employee_ssn'];
$sql = "SELECT store_id, store_uuid, store_name, store_address, promo_code, create_date FROM store_list NATURAL JOIN store_account WHERE store_id IN (SELECT store_id FROM responsible_for WHERE employee_ssn = {$employee_ssn}) AND store_id IN (SELECT store_id FROM store_account);";
$result = $model->execute($sql);
if (!$result) {
    $result = false;
} else {
    $count = count($result);
    $today = date("Y-m-d");
    for ($i = 0; $i < $count; $i++) {
        $store_id = $result[$i]['store_id'];
        $sql = "SELECT COUNT(*) FROM register_record WHERE store_uuid = '{$result[$i]['store_uuid']}';";
        $register_count = $model->execute($sql)[0]['COUNT(*)'];
        $result[$i]['register_count'] = $register_count;
        $daydiff = floor((abs(strtotime(date("Y-m-d")) - strtotime($result[$i]["create_date"])) / (60 * 60 * 24))) + 1;
        $average_count = round(($register_count / $daydiff), 2);
        $result[$i]['average_count'] = $average_count;
    }
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
