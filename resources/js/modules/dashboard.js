$(document).ready(function () {
    //会員一覧
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

    // 各個別のチェックボックスが変更されたときに、「select-all」チェックボックスの状態を更新
    $(".user-checkbox").change(function () {
        // もし、個別のチェックボックスがすべてチェックされていなければ、「select-all」は未チェック
        if ($(".user-checkbox:checked").length !== $(".user-checkbox").length) {
            $("#select-all").prop("checked", false);
        } else {
            // すべてのチェックボックスがチェックされていれば、「select-all-reservation」もチェック
            $("#select-all").prop("checked", true);
        }
    });

    // ユーザーの個別チェックボックスをクリックしたときの処理
    $(".user-checkbox").on("change", function () {
        toggleDeleteButton(); // 削除ボタンの状態を更新
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
                    url: "/admin/userList/delete-users", // 削除用のルート
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

    //予約一覧
    // "全選択" チェックボックスをクリックしたときの処理
    $("#select-all-reservation").change(function () {
        // "select-all" チェックボックスが変更されたときに、すべてのチェックボックスを選択/解除
        var isChecked = $(this).prop("checked");
        $(".reservation-checkbox").prop("checked", isChecked);
    });

    // 各個別のチェックボックスが変更されたときに、「select-all」チェックボックスの状態を更新
    $(".reservation-checkbox").change(function () {
        // もし、個別のチェックボックスがすべてチェックされていなければ、「select-all」は未チェック
        if (
            $(".reservation-checkbox:checked").length !==
            $(".reservation-checkbox").length
        ) {
            $("#select-all-reservation").prop("checked", false);
        } else {
            // すべてのチェックボックスがチェックされていれば、「select-all-reservation」もチェック
            $("#select-all-reservation").prop("checked", true);
        }
    });

    // '適応'ボタンがクリックされたとき
    $("#apply-btn").on("click", function () {
        // 操作が選ばれていない場合はアラート
        var action = $("#selectAnAction").val();
        if (action !== "cancel_reservations") {
            alert("操作を選択してください");
            return;
        }

        // 選択されている予約IDを取得
        var selectedIds = [];
        $(".reservation-checkbox:checked").each(function () {
            selectedIds.push($(this).data("id"));
        });

        // 予約が選ばれていない場合はアラート
        if (selectedIds.length === 0) {
            alert("キャンセルする予約を選択してください");
            return;
        }

        // Ajaxリクエスト
        $.ajax({
            url: "reservationList/cancel-reservations", // 送信先URL
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRFトークン
                reservation_ids: selectedIds, // 選択された予約ID
            },
            success: function (response) {
                if (response.success) {
                    alert("選択した予約がキャンセルされました");
                    location.reload(); // ページをリロードして変更を反映
                } else {
                    alert("エラーが発生しました");
                }
            },
            error: function (xhr, status, error) {
                alert("ネットワークエラーが発生しました");
            },
        });
    });
});
