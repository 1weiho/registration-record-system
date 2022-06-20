<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

if (isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["new_password_confirm"])) {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $new_password_confirm = $_POST["new_password_confirm"];
    if (empty($old_password)) {
        header("Location: ../../manage/resetPassword.php?state=請輸入舊密碼");
    } elseif (empty($new_password)) {
        header("Location: ../../manage/resetPassword.php?state=請輸入新密碼");
    } elseif (empty($new_password_confirm)) {
        header("Location: ../../manage/resetPassword.php?state=請再次輸入新密碼");
    } else {
        $employee_ssn = $_SESSION['employee_ssn'];
        require_once __DIR__ . "/../model/model.php";
        $model = new Model();
        $sql = $model->select('employee_account', ['employee_password']) . $model->where('employee_ssn', '=', $employee_ssn);
        $check_password = $model->execute($sql);
        $check_password = $check_password[0]['employee_password'];
        if (password_verify($old_password, $check_password)) {
            if ($new_password == $new_password_confirm) {
                $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = $model->update(["employee_password" => $hash_password], "employee_account") . $model->where("employee_ssn", "=", $employee_ssn);
                $result = $model->execute($sql);
                if ($result) {
                    header("Location: ../../manage/resetPassword.php?state=true");
                } else {
                    header("Location: ../../manage/resetPassword.php?state=密碼重設失敗");
                }
            } else {
                header("Location: ../../manage/resetPassword.php?state=新密碼輸入不一致");
            }
        } else {
            header("Location: ../../manage/resetPassword.php?state=舊密碼輸入錯誤");
        }
    }
} else {
    // 參數傳遞失敗
    header("Location: ../../manage/resetPassword.php?state=密碼重設失敗");
}
