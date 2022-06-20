<?php

session_start();
require_once __DIR__ . "/../model/model.php";
$model = new Model();

if (isset($_POST['email']) && isset($_POST['password'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		header("Location: ../../manage/login.php?error=請輸入電子信箱");
	} else if (empty($password)) {
		header("Location: ../../manage/login.php?error=請輸入密碼");
	} else {
		$sql = $model->select('employee_account', ['employee_password']) . $model->where('employee_email', '=', $email);
		$check_password = $model->execute($sql);
		if ($check_password) {
			$check_password = $check_password[0]['employee_password'];
			if (password_verify($password, $check_password)) {
				$sql = $model->select('employee_account', ['employee_ssn']) . $model->where('employee_email', '=', $email);
				$employee_ssn = $model->execute($sql)[0]['employee_ssn'];;
				$_SESSION['employee_ssn'] = $employee_ssn;
				header("Location: ../../manage/index.php");
			} else {
				header("Location: ../../manage/login.php?error=電子信箱或密碼有誤");
			}
		} else {
			header("Location: ../../manage/login.php?error=電子信箱或密碼有誤");
		}
	}
} else {
	header("Location: ../../manage/login.php?error=登入失敗");
}
