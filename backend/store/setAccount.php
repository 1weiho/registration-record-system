<?php

session_start();
if (!isset($_SESSION['store_id'])) {
    header("Location: ../../store/login.php");
}

if (isset($_POST["store_name"]) && isset($_POST["store_address"]) && isset($_POST["new_password"]) && isset($_POST["new_password_confirm"])) {
    $store_name = $_POST["store_name"];
    $store_address = $_POST["store_address"];
    $new_password = $_POST["new_password"];
    $new_password_confirm = $_POST["new_password_confirm"];
    if (empty($store_name)) {
        header("Location: ../../store/initializeAccount.php?state=請輸入店家名稱");
    } elseif (empty($store_address)) {
        header("Location: ../../store/initializeAccount.php?state=請輸入店家地址");
    } elseif (empty($new_password)) {
        header("Location: ../../store/initializeAccount.php?state=請輸入新密碼");
    } elseif (empty($new_password_confirm)) {
        header("Location: ../../store/initializeAccount.php?state=請再次輸入新密碼");
    } else {
        if ($new_password == $new_password_confirm) {
            $store_id = $_SESSION['store_id'];
            require_once __DIR__ . "/../model/model.php";
            $model = new Model();
            $sql = $model->update(["store_name" => $store_name, "store_address" => $store_address], "store_list") . $model->where("store_id", "=", $store_id);
            $result = $model->execute($sql);
            if ($result) {
                $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = $model->insert(["store_id" => $store_id, "store_password" => $hash_password], "store_account");
                $result = $model->execute($sql);
                if ($result) {
                    // 帳號初始成功
                    header("Location: ../../store/index.php");
                } else {
                    // 密碼未成功輸入至資料庫
                    header("Location: ../../store/initializeAccount.php?state=發生問題，請再試一次");
                }
            } else {
                // 店名、地址未成功輸入至資料庫
                header("Location: ../../store/initializeAccount.php?state=發生問題，請再試一次");
            }
        } else {
            header("Location: ../../store/initializeAccount.php?state=新密碼輸入不一致");
        }
    }
} else {
    // 參數傳遞失敗
    header("Location: ../../store/initializeAccount.php?state=儲存失敗");
}
