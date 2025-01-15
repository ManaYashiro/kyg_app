$(document).ready(function () {
    // 今日の予約ボタン
    $("#today-button").on("click", function () {
        const today = new Date().toISOString().split("T")[0];
        $("#date_from").val(today);
        $("#date_to").val(today);
        $("#search-form").submit();
    });

    // 明日の予約ボタン
    $("#tomorrow-button").on("click", function () {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split("T")[0];
        $("#date_from").val(tomorrowStr);
        $("#date_to").val(tomorrowStr);
        $("#search-form").submit();
    });

    $("#reset").on("click", function () {
        window.location.href = window.location.pathname;
    });
});

$(".clickable-row-reservation").on("click", function (e) {
    // チェックボックスのクリックの場合は遷移しない
    if ($(e.target).is('input[type="checkbox"]')) {
        return; // チェックボックスがクリックされた場合は何もしない
    }

    // ユーザーIDを取得
    var Id = $(this).find(".id-checkbox").data("id");
    // 編集画面に遷移（Bladeテンプレート内のURLを正しく展開するために、JavaScript内でURLを直接生成）
    var url = "/admin/reservationList/" + Id + "/edit/";
    window.location = url;
});
