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

    //会員新規登録
    // ラジオボタンが変更されたときに実行
    $('input[name="role"]').change(function () {
        updateLabel("zipcode");
        updateLabel("prefecture");
        updateLabel("address1");
        updateLabel("car_name");
        updateLabel("car_number");
        updateLabel("questionnaire");
        updateCallTimeLabel();
        updateRequiredForFields();
    });

    $('input[name="role"]').first().trigger("change");

    // 電話番号ラベルのoptionを変更する関数
    function updateLabel(key) {
        // 「管理者」を選択した場合
        if ($("#role-admin").is(":checked")) {
            var $label = $("#" + key + "-label span.isinputlabel"); // optionを「任意」に変更
            $label.text("任意");
            $label.addClass("form-any");
            $label.removeClass("form-required");

            var $input = $("#" + key); // inputを「任意」に変更
            $input.attr("required", false);
        } else {
            var $label = $("#" + key + "-label span.isinputlabel"); // optionを「必須」に変更
            $label.text("必須");
            $label.addClass("form-required");
            $label.removeClass("form-any");

            var $input = $("#" + key); // inputを「必須」に変更
            $input.attr("required", true);
        }
    }

    // 電話連絡時間帯のラベルとrequired属性を変更する関数
    function updateCallTimeLabel() {
        // 「管理者」を選択した場合
        if ($("#role-admin").is(":checked")) {
            // 「必須」のラベルを「任意」に変更
            $("#call_time-label span.isinputlabel")
                .text("任意")
                .addClass("form-any")
                .removeClass("form-required");

            // 各ラジオボタンのrequired属性を外す
            $("input[name='call_time']").each(function () {
                $(this).removeAttr("required");
            });
        } else {
            // 「任意」のラベルを「必須」に戻す
            $("#call_time-label span.isinputlabel")
                .text("必須")
                .addClass("form-required")
                .removeClass("form-any");

            // 各ラジオボタンのrequired属性を必須に戻す
            $("input[name='call_time']").each(function () {
                $(this).attr("required", true);
            });
        }
    }

    function updateRequiredForFields() {
        const isAdmin = $("#role-admin").is(":checked");

        // car_name_1 と car_number_1 の required 属性を変更
        $("input[name='car_name[]'], input[name='car_number[]']").each(
            function () {
                if (
                    $(this).attr("id") === "car_name_1" ||
                    $(this).attr("id") === "car_number_1"
                ) {
                    $(this).attr("required", !isAdmin); // 管理者ならrequiredを外す
                }
            }
        );

        // is_receive_notification-1 と is_receive_notification-2 の required 属性を変更
        if (isAdmin) {
            // 管理者の場合は required を外す
            $("input[name='is_receive_notification']").each(function () {
                $(this).removeAttr("required"); // 管理者ならrequiredを外す
            });

            // ラベルのテキストを「任意」に変更
            $("#is_receive_notification-label span.isinputlabel")
                .text("任意")
                .removeClass("form-required")
                .addClass("form-any");
        } else {
            // 管理者以外の場合は required を追加
            $("input[name='is_receive_notification']").each(function () {
                $(this).attr("required", true); // 管理者以外ならrequiredを追加
            });

            // ラベルのテキストを「必須」に変更
            $("#is_receive_notification-label span.isinputlabel")
                .text("必須")
                .removeClass("form-any")
                .addClass("form-required");
        }

        // person_type の required 属性を変更とラベルの変更
        if (isAdmin) {
            // 管理者の場合は person_type の required を外す
            $("input[name='person_type']").each(function () {
                $(this).removeAttr("required"); // 管理者ならrequiredを外す
            });

            // person_type のラベルテキストを「任意」に変更
            $("#person_type-label span.isinputlabel")
                .text("任意")
                .removeClass("form-required")
                .addClass("form-any");
        } else {
            // 管理者以外の場合は person_type の required を追加
            $("input[name='person_type']").each(function () {
                $(this).attr("required", true); // 管理者以外ならrequiredを追加
            });

            // person_type のラベルテキストを「必須」に変更
            $("#person_type-label span.isinputlabel")
                .text("必須")
                .removeClass("form-any")
                .addClass("form-required");
        }
    }
});
