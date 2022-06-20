<?php

session_start();
require_once __DIR__ . "/../backend/model/model.php";
$model = new Model();

if (!isset($_SESSION['store_id'])) {
    header("Location: login.php");
} else {
    $store_id = $_SESSION['store_id'];
    $sql = $model->select('store_list', ['store_name']) . $model->where('store_id', '=', $store_id);
    $store_name = $model->execute($sql)[0]['store_name'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link rel="stylesheet" href="../style/store/store.css?2022062101">
        <link rel="shortcut icon" href="../src/image/ico.png" type="image/x-icon">
        <title>店家後台系統 | 主頁</title>
    </head>

    <body>
        <div class="option-list mb-5 mt-2 me-2 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    選項
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="./index.php">主頁</a></li>
                    <li><a class="dropdown-item" href="./editProfile.php">變更店家資訊</a></li>
                    <li><a class="dropdown-item" href="./resetPassword.php">變更密碼</a></li>
                    <li><a class="dropdown-item" href="./logout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <h3 class="text-center"><?php echo $store_name ?>，您好！</h3>
        <p class="text-center">目前統計報名人數：<a id="record-count"></a> 人</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>家長姓名</th>
                    <th>家長電話</th>
                    <th>報名時間</th>
                </tr>
            </thead>
            <tbody id="register-table">
            </tbody>
        </table>

        <!-- Google api jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="../script/store/registerRecord.js"></script>
    </body>

<?php
}
?>