<?php

session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../../store/login.php");
}

require_once __DIR__ . "/../model/model.php";
$model = new Model();

$store_id = $_SESSION['store_id'];
$sql = $model->select("store_list", ['store_name', 'store_address']) . $model->where('store_id', '=', $store_id);
$result = $model->execute($sql);

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
