$(document).ready(function() {
    $('.company-edit').on('submit', function(event) {
        let formValid = true;

        // 全ての入力フィールドをループしてバリデーションを行う
        $('.company-edit input').each(function() {
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
        const errorMessage4 = $('.error-message4');

        if (postcode == '') {
            formValid = false;
            $('#postcode').addClass('invalid');
            $('#postcode').parent('.input-container').addClass('error');
            errorMessage2.hide();
            errorMessage3.hide();
            errorMessage4.hide();               
        } else if (postcode.includes('-') && /[^0-9-]/.test(postcode)) {
            formValid = false;
            $('#postcode').addClass('invalid');
            $('#postcode').parent('.input-container').addClass('error');
            errorMessage2.show().addClass('active');
            errorMessage3.show().addClass('active');
            errorMessage4.hide();
        } else if (/[^0-9-]/.test(postcode)) {
            formValid = false;
            $('#postcode').addClass('invalid');
            $('#postcode').parent('.input-container').addClass('error');
            errorMessage3.show().removeClass('active');
            errorMessage2.hide();
            errorMessage4.hide();
        } else if (postcode.includes('-')) {
            formValid = false;
            $('#postcode').addClass('invalid');
            $('#postcode').parent('.input-container').addClass('error');
            errorMessage2.show().removeClass('active');
            errorMessage3.hide();
            errorMessage4.hide();
        } else if (!/^\d{7}$/.test(postcode)){
            formValid = false;
            $('#postcode').addClass('invalid');
            $('#postcode').parent('.input-container').addClass('error');
            errorMessage2.hide();
            errorMessage3.hide();
            errorMessage4.show(); 
        } else {
            $('#postcode').removeClass('invalid');
            $('#postcode').parent('.input-container').removeClass('error');
            errorMessage2.hide().removeClass('active');
            errorMessage3.hide().removeClass('active');
            errorMessage4.hide();
            
        }

        // フォーム送信時にのみバリデーションを行う
        if (!formValid) {
            event.preventDefault(); // フォーム送信をキャンセル
        }
    });
});