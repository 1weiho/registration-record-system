<?php

require_once __DIR__ . "/../backend/promoCode.php";
if (isset($_GET['id'])) {
    $store_uuid = $_GET['id'];
    $promoCode = new promoCode();
    if ($promoCode->getPromoCode($store_uuid)) {
        $promo_code = $promoCode->getPromoCode($store_uuid)[0]['promo_code'];
    } else {
        header("Location: ../error/");
    }
} else {
    header("Location: ../error/");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/register.css">
    <link rel="shortcut icon" href="../src/image/ico.png" type="image/x-icon">
    <title>國際兒童腦科學皮紋檢測</title>
</head>

<body class="text-center">
    <!-- Modal -->
    <div class="modal fade text-start" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">提醒</h5>
                </div>
                <div class="modal-body">
                    本頁面僅用於確認是否曾有報名紀錄，請按下方按鈕前往報名頁面填寫完整資料及<a class="text-primary text-decoration-none">優惠碼：<?php echo $promo_code ?></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="modal-submit-btn">
                        前往報名
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Form -->
    <main class="form-register">
        <form action="./check.php" method="POST" id="form">
            <img src="../src/image/logo.png" class="w-25 mb-2">
            <h1 class="fs-4 mb-3 fw-normal">國際兒童腦科學皮紋檢測</h1>

            <div class="form-floating">
                <input type="text" name="parent_name" class="form-control input-parent-name" id="floatingInput" placeholder="請輸入家長姓名" required />
                <label for="floatingInput">家長姓名</label>
            </div>
            <div class="form-floating">
                <input type="text" name="phone_num" class="form-control input-phone-num" id="floatingPassword" placeholder="請輸入家長電話" required />
                <label for="floatingPassword">家長電話</label>
            </div>
            <a class="w-100 btn btn-lg btn-primary" id="next-btn">下一步</a>
            <input type="hidden" name="token" id="token" value="<?php echo $store_uuid ?>" />
            <input type="submit" class="submit-btn" id="submit-btn" />
        </form>
    </main>
    <!-- Google api jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="../script/register.js"></script>
</body>

</html>