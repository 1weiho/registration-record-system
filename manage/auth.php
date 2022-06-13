<?php

session_start();
require "../backend/model.php";
$model = new Model();

if (isset($_POST['promo_code']) && isset($_POST['password'])) {

	$promo_code = $_POST['promo_code'];
	$password = $_POST['password'];

	if (empty($promo_code)) {
		header("Location: login.php?error=請輸入店家優惠碼");
	} else if (empty($password)) {
		header("Location: login.php?error=請輸入密碼");
	} else {
		$sql = $model->select('store_list', ['store_id']) . $model->where('promo_code', '=', $promo_code);
		$store_id = $model->execute($sql);
		if ($store_id) {
			$store_id = $store_id[0]['store_id'];
			$sql = $model->select('store_account', ['store_password']) . $model->where('store_id', '=', $store_id);
			$check_password = $model->execute($sql);
			if ($check_password) {
				$check_password = $check_password[0]['store_password'];
				if (password_verify($password, $check_password)) {
					$_SESSION['user_id'] = $store_id;
					header("Location: index.php");
				} else {
					header("Location: login.php?error=店家優惠碼或密碼有誤");
				}
			} else {
				if ($password == $promo_code) {
					$_SESSION['user_id'] = $store_id;
					header("Location: initializeAccount.php");
				} else {
					header("Location: login.php?error=店家優惠碼或密碼有誤");
				}
			}
		} else {
			header("Location: login.php?error=店家優惠碼或密碼有誤");
		}
	}
} else {
	header("Location: login.php?error=登入失敗");
}
