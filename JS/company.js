$(document).ready(function() {
    $(".top-btn").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "normal");
    });
});

//---モーダル---

// 「会社データ削除」リンクがクリックされたときの処理
$(".company-dlt").click(function(e) {
    e.preventDefault(); // リンクのデフォルト動作をキャンセル

    // モーダルを表示する
    $("#my-modal").show();
});

// 「キャンセル」ボタンがクリックされたときの処理
$(".close-button, .cancel-btn").click(function() {
    // モーダルを閉じる
    $("#my-modal").hide();

});