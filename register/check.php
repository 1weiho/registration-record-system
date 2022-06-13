<?php

if (isset($_POST["parent_name"]) && isset($_POST["phone_num"]) && isset($_POST["token"])) {
    $parent_name = $_POST["parent_name"];
    $phone_num = $_POST["phone_num"];
    $token = $_POST["token"];
    if (empty($parent_name) || empty($phone_num) || empty($token)) {
        header("Location: ../error/");
    } else {
        $register_time = date("Y-m-d H:i:s");
        require "../backend/model.php";
        $model = new Model();
        $sql = $model->insert(['parent_name' => $parent_name, 'phone_num' => $phone_num, 'register_time' => $register_time, 'store_uuid' => $token], 'register_record');
        $result = $model->execute($sql);
        if ($result) {
            header("Location: https://ceoedm.com.tw/seller/");
        } else {
            // 報名失敗
            header("Location: ../error/");
        }
    }
} else {
    // 參數傳遞失敗
    header("Location: ../error/");
}
