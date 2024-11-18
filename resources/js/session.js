$(document).ready(function () {
    // セッションメッセージが表示されている場合
    if ($("#success-message").length) {
        // 5秒後にメッセージを非表示にする
        setTimeout(function () {
            $("#success-message").fadeOut("slow");
        }, 5000); // 5000ミリ秒（5秒後）に実行
    }
});
