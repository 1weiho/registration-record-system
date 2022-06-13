<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["new_password_confirm"])) {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $new_password_confirm = $_POST["new_password_confirm"];
    if (empty($old_password)) {
        header("Location: resetPassword.php?state=請輸入舊密碼");
    } elseif (empty($new_password)) {
        header("Location: resetPassword.php?state=請輸入新密碼");
    } elseif (empty($new_password_confirm)) {
        header("Location: resetPassword.php?state=請再次輸入新密碼");
    } else {
        $store_id = $_SESSION['user_id'];
        require "../backend/model.php";
        $model = new Model();
        $sql = $model->select('store_account', ['store_password']) . $model->where('store_id', '=', $store_id);
        $check_password = $model->execute($sql);
        $check_password = $check_password[0]['store_password'];
        if (password_verify($old_password, $check_password)) {
            if ($new_password == $new_password_confirm) {
                $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = $model->update(["store_password" => $hash_password], "store_account") . $model->where("store_id", "=", $store_id);
                $result = $model->execute($sql);
                if ($result) {
                    header("Location: resetPassword.php?state=true");
                } else {
                    header("Location: resetPassword.php?state=密碼重設失敗");
                }
            } else {
                header("Location: resetPassword.php?state=新密碼輸入不一致");
            }
        } else {
            header("Location: resetPassword.php?state=舊密碼輸入錯誤");
        }
    }
} else {
    // 參數傳遞失敗
    header("Location: resetPassword.php?state=密碼重設失敗");
}
