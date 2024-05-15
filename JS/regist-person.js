$(document).ready(function () {
    $('.person-regist').on('submit', function (event) {
        let formValid = true;

        // 全ての入力フィールドをループしてバリデーションを行う
        $('.input').each(function () {
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

        // 電話番号のバリデーション
        const telNumber = $('#tel').val();
        const errorMessage2 = $('.error-message2');
        const errorMessage3 = $('.error-message3');
        const errorMessage5 = $('.error-message5');

        if (telNumber !== '') {
            if (telNumber.includes('-') && /[^0-9-]/.test(telNumber)) {
                formValid = false;
                $('#tel').addClass('invalid');
                $('#tel').parent('.input-container').addClass('error');
                errorMessage2.show().addClass('active');
                errorMessage3.show().addClass('active');
                errorMessage5.hide();
            } else if (telNumber.includes('-')) {
                formValid = false;
                $('#tel').addClass('invalid');
                $('#tel').parent('.input-container').addClass('error');
                errorMessage2.show().removeClass('active');
                errorMessage3.hide();
                errorMessage5.hide();
            } else if (/[^0-9-]/.test(telNumber)) {
                formValid = false;
                $('#tel').addClass('invalid');
                $('#tel').parent('.input-container').addClass('error');
                errorMessage3.show().removeClass('active');
                errorMessage2.hide();
                errorMessage5.hide();
            } else if (telNumber.length > 15) {
                formValid = false;
                $('#tel').addClass('invalid');
                $('#tel').parent('.input-container').addClass('error');
                errorMessage2.hide();
                errorMessage3.hide();
                errorMessage5.show();
            } else {
                $('#tel').removeClass('invalid');
                $('#tel').parent('.input-container').removeClass('error');
                errorMessage2.hide();
                errorMessage3.hide();
                errorMessage5.hide();
            }
        } else {
            $('#tel').removeClass('invalid');
            $('#tel').parent('.input-container').removeClass('error');
            errorMessage2.hide();
            errorMessage3.hide();
            errorMessage5.hide();
        }

        // メールアドレスのバリデーション
        const email = $('#mail').val();
        const errorMessage4 = $('.error-message4');

        if (email !== '') {
            if (!email.includes('@')) {
                formValid = false;
                $('#mail').addClass('invalid');
                $('#mail').parent('.input-container').addClass('error');
                errorMessage4.show();
            } else {
                $('#mail').removeClass('invalid');
                $('#mail').parent('.input-container').removeClass('error');
                errorMessage4.hide();
            }
        } else {
            $('#mail').removeClass('invalid');
            $('#mail').parent('.input-container').removeClass('error');
            errorMessage4.hide();
        }

        // フォーム送信時にのみバリデーションを行う
        if (!formValid) {
            event.preventDefault(); // フォーム送信をキャンセル
        }
    });
});