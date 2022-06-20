<?php

session_start();
require_once __DIR__ . "/../backend/model/model.php";
$model = new Model();

if (!isset($_SESSION['employee_ssn'])) {
    header("Location: login.php");
} else {
    $employee_ssn = $_SESSION['employee_ssn'];
    $sql = $model->select('employee_list', ['employee_name']) . $model->where('employee_ssn', '=', $employee_ssn);
    $employee_name = $model->execute($sql)[0]['employee_name'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link rel="stylesheet" href="../style/manage/manageStore.css">
        <link rel="shortcut icon" href="../src/image/ico.png" type="image/x-icon">
        <title>業務後台系統 | 管理店家</title>
    </head>

    <body>
        <div class="option-list mb-5 mt-2 me-2 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    選項
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="./index.php">主頁</a></li>
                    <li><a class="dropdown-item" href="./manageStore.php">管理店家</a></li>
                    <li><a class="dropdown-item" href="./editProfile.php">變更個人資訊</a></li>
                    <li><a class="dropdown-item" href="./resetPassword.php">變更密碼</a></li>
                    <li><a class="dropdown-item" href="./logout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <h3 class="text-center">目前已發送 <a id="record-count"></a> 間店家</h3>
        <div id="store-area"></div>

        <!-- Google api jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="../script/manage/manageStore.js?2022062102"></script>
    </body>

<?php
}
?>