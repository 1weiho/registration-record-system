<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../manage/login.php");
}

require_once('model.php');
$model = new Model();

$store_id = $_SESSION['user_id'];
$sql = $model->select("store_list", ['store_name', 'store_address']) . $model->where('store_id', '=', $store_id);
$result = $model->execute($sql);

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
