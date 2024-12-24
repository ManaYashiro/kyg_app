$(document).ready(function () {
    // キャンセルボタンのクリックイベント
    $("#button-cancel").on("click", function () {
        // 予約IDを取得 (data-appointment-id属性から取得)
        const appointmentId = $(this).data("appointment-id");

        // 確認ダイアログを表示
        if (confirm("予約をキャンセルしてもよろしいですか？")) {
            // CSRFトークンを取得
            const token = $('meta[name="csrf-token"]').attr("content");

            // Ajax リクエストを送信
            $.ajax({
                url: `/appointmentsList/${appointmentId}`, // 実際のルートパスに修正
                type: "POST",
                data: {
                    _method: "DELETE", // DELETEメソッドをエミュレート
                    _token: token,
                },
                success: function (response) {
                    // 成功時の処理
                    alert("予約をキャンセルしました。");
                    // 一覧ページにリダイレクト
                    window.location.href = route("appointmentList.index"); // route()ヘルパーを使用
                },
                error: function (xhr, status, error) {
                    // エラー時の処理
                    alert(
                        "予約のキャンセルに失敗しました。もう一度お試しください。"
                    );
                    console.error("Error:", error);
                },
            });
        }
    });
});
