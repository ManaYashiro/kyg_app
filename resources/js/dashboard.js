$(document).ready(function () {
    // 行全体をクリックして編集ページに遷移
    $(".clickable-row").on("click", function (e) {
        // チェックボックスのクリックの場合は遷移しない
        if ($(e.target).is('input[type="checkbox"]')) {
            return; // チェックボックスがクリックされた場合は何もしない
        }

        // ユーザーIDを取得
        var userId = $(this).find(".user-checkbox").data("id");
        // 編集画面に遷移（Bladeテンプレート内のURLを正しく展開するために、JavaScript内でURLを直接生成）
        var url = "/admin/userList/" + userId + "/edit/";
        window.location = url;
    });

    // "全選択" チェックボックスをクリックしたときの処理
    $("#select-all").on("change", function () {
        var isChecked = $(this).prop("checked");
        $(".user-checkbox").prop("checked", isChecked);
        toggleDeleteButton(); // 削除ボタンの状態を更新
    });

    // ユーザーの個別チェックボックスをクリックしたときの処理
    $(".user-checkbox").on("change", function () {
        toggleDeleteButton(); // 削除ボタンの状態を更新
    });

    // 削除ボタンがクリックされたときの処理
    $("#delete-selected").on("click", function () {
        var selectedIds = [];
        $(".user-checkbox:checked").each(function () {
            selectedIds.push($(this).data("id"));
        });

        if (selectedIds.length > 0) {
            // 削除確認ダイアログ
            if (confirm("選択したユーザーを削除しますか？")) {
                $.ajax({
                    url: "/admin/userList/delete", // 削除用のルート
                    method: "POST",
                    data: {
                        ids: selectedIds,
                        _token: $('meta[name="csrf-token"]').attr("content"), // CSRFトークン
                    },
                    success: function (response) {
                        location.reload(); // 削除後、ページをリロード
                    },
                });
            }
        } else {
            alert("削除するユーザーを選択してください。");
        }
    });

    // 削除ボタンの有効/無効を切り替える関数
    function toggleDeleteButton() {
        var selectedCount = $(".user-checkbox:checked").length;
        if (selectedCount > 0) {
            $("#delete-selected").prop("disabled", false);
        } else {
            $("#delete-selected").prop("disabled", true);
        }
    }
});
