<?php

session_start();
if (isset($_SESSION['store_id'])) {
    header("Location: index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link rel="stylesheet" href="../style/store/login.css">
        <link rel="shortcut icon" href="../src/image/ico.png" type="image/x-icon">
        <title>店家後台系統 | 登入</title>
    </head>

    <body class="text-center">
        <!-- Modal -->
        <div class="modal fade text-start" id="modal-error" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">提醒</h5>
                    </div>
                    <div class="modal-body" id="modal-text"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modal-submit-btn">
                            關閉
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form -->
        <main class="form-register">
            <form action="../backend/store/auth.php" method="POST">
                <img src="../src/image/logo.png" class="w-25 mb-2">
                <h1 class="fs-4 mb-3 fw-normal">店家後台系統</h1>

                <div class="form-floating">
                    <input type="text" name="promo_code" class="form-control input-parent-name" id="floatingInput" placeholder="請輸入店家優惠碼" required />
                    <label for="floatingInput">店家優惠碼</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control input-phone-num" id="floatingPassword" placeholder="請輸入密碼" required />
                    <label for="floatingPassword">密碼</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">登入</button>
            </form>
        </main>
        <!-- Google api jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="../script/store/login.js"></script>
    </body>

    </html>

<?php

}

?>