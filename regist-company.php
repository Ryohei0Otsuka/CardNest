<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Nest</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="CSS/style03.css">
    <link rel="icon" href="img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Noto+Sans+JP:wght@100..900&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="top-link">
                <a href="index.php">
                    <p class="title">Card Nest</p>
                    <img src="img/icon.jpg" alt="Card Nest">
                </a>
            </div>
            <a class="top" href="index.php">
                <p>登録会社一覧</p>
            </a>
        </header>
        <hr>

        <main>
            <div class="regist-title">
                <p>会社データ登録</p>
            </div>

            <form class="company-regist" action="insert-company.php" method="post" autocomplete="off">
                <div class="input-container">
                    <label for="company">会社名</label><br>
                    <input type="text" name="company" class="input" id="company">
                    <span class="error-message">会社名を入力してください</span>
                </div>
                <div class="input-container">
                    <label for="postcode">郵便番号(ハイフンを除いて入力してください)</label><br>
                    <input type="text" name="postcode" class="input" id="postcode">
                    <span class="error-message">郵便番号を入力してください</span>
                    <span class="error-message2">ハイフンを除いて入力してください</span>
                    <span class="error-message3">半角数字のみを入力してください</span>

                </div>
                <div class="input-container">
                    <label for="address">住所</label><br>
                    <input type="text" name="address" class="input" id="address">
                    <span class="error-message">住所を入力してください</span>
                </div>
                <div class="input-container">
                    <label for="registered-by">登録者氏名</label><br>
                    <input type="text" name="registeredBy" class="input" id="registered-by">
                    <span class="error-message">登録者氏名を入力してください</span>
                </div>
                <div class="regi-btn-wrap">
                    <input class="regi-btn" type="submit" value="登録">
                </div>
            </form>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.company-regist').on('submit', function(event) {
                let formValid = true;

                // 全ての入力フィールドをループしてバリデーションを行う
                $('.company-regist input').each(function() {
                    const errorMessage = $(this).next('.error-message');
                    if ($(this).val() == '') {
                        formValid = false;
                        $(this).addClass('invalid');
                        $(this).parent('.input-container').addClass('error');
                        errorMessage.show();
                    } else {
                        $(this).removeClass('invalid');
                        $(this).parent('.input-container').removeClass('error');
                        errorMessage.hide();
                    }
                });

                // 郵便番号のバリデーション
                const postcode = $('#postcode').val();
                const errorMessage2 = $('.error-message2');
                const errorMessage3 = $('.error-message3');

                if (postcode == '') {
                    formValid = false;
                    $('#postcode').addClass('invalid');
                    $('#postcode').parent('.input-container').addClass('error');
                    errorMessage2.hide();
                    errorMessage3.hide();
                } else if (postcode.includes('-') && /[^0-9-]/.test(postcode)) {
                    formValid = false;
                    $('#postcode').addClass('invalid');
                    $('#postcode').parent('.input-container').addClass('error');
                    errorMessage2.show().addClass('active');
                    errorMessage3.show().addClass('active');
                } else if (/[^0-9-]/.test(postcode)) {
                    formValid = false;
                    $('#postcode').addClass('invalid');
                    $('#postcode').parent('.input-container').addClass('error');
                    errorMessage3.show().removeClass('active');
                    errorMessage2.hide();
                } else if (postcode.includes('-')) {
                    formValid = false;
                    $('#postcode').addClass('invalid');
                    $('#postcode').parent('.input-container').addClass('error');
                    errorMessage2.show().removeClass('active');
                    errorMessage3.hide();
                } else {
                    $('#postcode').removeClass('invalid');
                    $('#postcode').parent('.input-container').removeClass('error');
                    errorMessage2.hide().removeClass('active');
                    errorMessage3.hide().removeClass('active');
                }



                // フォーム送信時にのみバリデーションを行う
                if (!formValid) {
                    event.preventDefault(); // フォーム送信をキャンセル
                }
            });
        });
    </script>
</body>

</html>