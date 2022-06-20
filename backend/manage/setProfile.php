<?php

session_start();
if (!isset($_SESSION['employee_ssn'])) {
    header("Location: ../../manage/login.php");
}

if (isset($_POST["employee_name"]) && isset($_POST["employee_email"])) {
    $employee_name = $_POST["employee_name"];
    $employee_email = $_POST["employee_email"];
    if (empty($employee_name) || empty($employee_email)) {
        header("Location: ../../manage/editProfile.php?state=false");
    } else {
        $employee_ssn = $_SESSION['employee_ssn'];
        require_once __DIR__ . "/../model/model.php";
        $model = new Model();
        $sql = $model->update(["employee_name" => $employee_name], "employee_list") . $model->where("employee_ssn", "=", $employee_ssn);
        $result_name = $model->execute($sql);
        $sql = $model->update(["employee_email" => $employee_email], "employee_account") . $model->where("employee_ssn", "=", $employee_ssn);
        $result_email = $model->execute($sql);
        if ($result_name || $result_email) {
            header("Location: ../../manage/editProfile.php?state=true");
        } else {
            header("Location: ../../manage/editProfile.php?state=false");
        }
    }
} else {
    // 參數傳遞失敗
    header("Location: ../../manage/editProfile.php?state=false");
}
