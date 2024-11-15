$(document).ready(function () {
    // 行のクリックイベントを追加
    $(".clickable-row").on("click", function () {
        // クリックした行からデータを取得
        var id = $(this).data("id");
        var content = $(this).data("content");
        var title = $(this).data("title");
        var category = $(this).data("category");
        var publishedAt = $(this).data("published_at");
        var isActive = $(this).data("is_active");
        var image = $(this).data("image");

        // フォームの入力フィールドにデータを設定
        $("#title").val(title);
        $("#content").val(content);
        $("#category").val(parseInt(category)); // categoryを数値に変換
        $("#published_at").val(publishedAt);

        // IDをhiddenフィールドにセット
        $("#notification-id").val(id);

        // is_activeのラジオボタンを選択状態にする
        $('input[name="is_active"][value="' + isActive + '"]').prop(
            "checked",
            true
        );

        // ファイル名の表示 (imageのパスを表示)
        $("#file-name").text(image);

        $('input[name="id"]').val(id);
    });

    // 画像選択の変更イベント
    $("#image").on("change", function () {
        var fileName = this.files[0] ? this.files[0].name : "";
        $("#file-name").text(fileName); // 選択されたファイル名を表示
    });

    let selectedRowId = null; // 選択された行のIDを保持

    // 行をクリックしたとき
    $(".clickable-row").on("click", function () {
        selectedRowId = $(this).data("id"); // 選択された行のIDを保持
        $("#delete-btn").prop("disabled", false); // 削除ボタンを有効化
        // 他の行からselectedクラスを削除
        $(".clickable-row").removeClass("selected");

        // クリックした行にselectedクラスを追加
        $(this).addClass("selected");
    });

    // 削除ボタンがクリックされたとき
    $("#delete-btn").on("click", function () {
        if (selectedRowId !== null) {
            if (confirm("本当に削除しますか？")) {
                // Ajaxで削除リクエストを送信
                $.ajax({
                    url: "/admin/notificationSetting/" + selectedRowId, // 削除するリソースのURL
                    type: "POST", // メソッドはPOSTに変更
                    data: {
                        _method: "DELETE", // DELETEメソッドを模倣
                        _token: $('meta[name="csrf-token"]').attr("content"), // CSRFトークン
                    },
                    success: function (response) {
                        alert("削除が完了しました");
                        // 行をテーブルから削除
                        $('tr[data-id="' + selectedRowId + '"]').remove();
                        selectedRowId = null; // IDをリセット
                        $("#delete-btn").prop("disabled", true); // 削除ボタンを無効化

                        // フォームの入力フィールドをクリア
                        $("#notification-id").val(""); // 隠しIDフィールド
                        $("#title").val(""); // タイトル
                        $("#content").val(""); // コンテンツ
                        $("#category").val(""); // カテゴリ
                        $("#published_at").val(""); // 公開日
                        $("#is_active").prop("checked", false); // 公開状態（ラジオボタンの場合）
                        $("#image").val(""); // 画像
                    },
                    error: function (xhr, status, error) {
                        alert("削除に失敗しました");
                    },
                });
            }
        } else {
            alert("削除する行を選択してください");
        }
    });
});
