<?php

function hidestr($string, $start = 0, $length = 0, $re = '*') {
    if (empty($string)) return false;
    $strarr = array();
    $mb_strlen = mb_strlen($string);
    while ($mb_strlen) {
        $strarr[] = mb_substr($string, 0, 1, 'utf8');
        $string = mb_substr($string, 1, $mb_strlen, 'utf8');
        $mb_strlen = mb_strlen($string);
    }
    $strlen = count($strarr);
    $begin = $start >= 0 ? $start : ($strlen - abs($start));
    $end = $last = $strlen - 1;
    if ($length > 0) {
        $end = $begin + $length - 1;
    } elseif ($length < 0) {
        $end -= abs($length);
    }
    for ($i = $begin; $i <= $end; $i++) {
        $strarr[$i] = $re;
    }
    if ($begin > $end || $begin >= $last || $end > $last) return false;
    return implode('', $strarr);
}

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../manage/login.php");
}

require_once('model.php');
$model = new Model();

$store_id = $_SESSION['user_id'];
$sql = $model->select("store_list", ['store_uuid']) . $model->where('store_id', '=', $store_id);
$store_uuid = $model->execute($sql)[0]['store_uuid'];
$sql = $model->select("register_record", ['parent_name', 'phone_num', 'register_time']) . $model->where('store_uuid', '=', $store_uuid);
$result = $model->execute($sql);

$count = count($result);
for ($i = 0; $i < $count; $i++) {
    $parent_name = $result[$i]['parent_name'];
    $phone_num = $result[$i]['phone_num'];
    $result[$i]['parent_name'] = hidestr($parent_name, 1, -1, 'O');
    $result[$i]['phone_num'] = hidestr($phone_num, 3, 4, 'X');
    $result[$i]['serial_num'] = $i + 1;
}

$return = json_encode($result);
header("Content-Type: application/json;");
echo $return;
