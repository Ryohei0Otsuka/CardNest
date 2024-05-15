//---モーダル---
$(document).ready(function () {
    // 「会社データ削除」リンクがクリックされたときの処理
    $(".person-dlt").click(function (e) {
        e.preventDefault(); // リンクのデフォルト動作をキャンセル

        // モーダルを表示する
        $("#my-modal").show();
    });

    // 「キャンセル」ボタンがクリックされたときの処理
    $(".close-button, .cancel-btn").click(function () {
        // モーダルを閉じる
        $("#my-modal").hide();
    });
});

formatPhoneNumber();