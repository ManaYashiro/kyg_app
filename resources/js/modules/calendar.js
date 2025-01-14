window.initialLoadedIcons = false;

function fontAwesomeLoaded() {
    return new Promise((resolve) => {
        const observer = new MutationObserver((mutationList, observer) => {
            for (const mutation of mutationList) {
                if (
                    mutation.target.classList.contains(
                        "fontawesome-i2svg-complete"
                    )
                ) {
                    observer.disconnect();
                    resolve(true);
                }
            }
        });

        observer.observe(document.documentElement, { attributes: true });
    });
}

// STEP06: 予約日時のクリック時
$(document).ready(function () {
    // 郵便番号がエラー発生ので、コメントします。
    // $.ajaxSetup({
    //     headers: {},
    // });

    // ラジオボタンが選択された時
    $('input[name="store"]').on("change", function () {
        var selectedStoreValue = $(this).val();
        $("#selectedStore").val(selectedStoreValue); // 隠しフィールドに選択された値を設定
    });
    // ラジオボタンが選択された時
    $('input[name="taskcategory"]').on("change", function () {
        var selectedcategoryValue = $(this).val();
        $("#selectedtaskcategory").val(selectedcategoryValue); // 隠しフィールドに選択された値を設定
    });
    // チェックボックスが選択された時
    $(document).on("click", 'input[name="reservation_task"]', function () {
        var selectedreservationtaskValue = $(this).val();
        $("#selectedreservationtask").val(selectedreservationtaskValue); // 隠しフィールドに選択された値を設定
    });
});

fontAwesomeLoaded().then(() => {
    // カレンダーを一度だけレンダリングする
    if (window.initialLoadedIcons) {
        return true;
    }

    let displayDate = new Date();
    var calendarEl = document.getElementById("calendar"); //ID要素を取得
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "timeGridWeek", //週間
        locale: "ja", //日本語
        height: "auto", //高さの自動調整
        allDaySlot: false, //終日
        initialDate: displayDate,
        firstDay: import.meta.env.VITE_APPOINTMENT_DAY_START,

        headerToolbar: {
            //ヘッダー要素にボタン/カスタムボタンを追加する
            right: "prevMonth prevWeek nextWeek nextMonth", //右側にボタンを追加
            left: "chokkinNoJoukyo openCalendar", //左側にボタンを追加
        },

        slotMinTime: import.meta.env.VITE_APPOINTMENT_TIME_START, //開始時間
        slotMaxTime: import.meta.env.VITE_APPOINTMENT_TIME_END, //終了時間
        slotDuration: import.meta.env.VITE_APPOINTMENT_TIME_INTERVAL, //時間の区切り

        slotLabelFormat: {
            hour: "numeric", //時刻を数字で表示
            minute: "2-digit", //分を2桁で表示
            omitZeroMinute: false, //0分も00と表示
        },

        buttonText: {
            //ボタン名表記
        },

        //カスタムボタン追加
        customButtons: {
            // これにより、予約されていない時間を持つ最も早い週が取得されます。
            // 日付が取得されたら、返された日付を割り当てて、`events` メソッドが再実行されます
            // API を 2 回実行します。
            chokkinNoJoukyo: {
                text: "直近の状況",
                click: function () {
                    $.ajax({
                        url: "/appointmentList/go-to/unreserved",
                        type: "GET",
                        headers: {
                            "X-CSRF-TOKEN": window.csrf_token,
                        },
                        data: {},
                        dataType: "json",
                        beforeSend: function () {},
                        complete: function () {},
                        success: function (response) {
                            displayDate = new Date(response.date);
                            calendar.gotoDate(displayDate);
                            calendarModalViewMonth.gotoDate(displayDate);
                        },
                        error: function (error) {},
                    });
                },
            },
            prevMonth: {
                text: "前月",
                click: function () {
                    displayDate.setMonth(displayDate.getMonth() - 1); //日付をアップデート
                    calendar.incrementDate({ months: -1 }); // 1ヶ月戻る
                    calendarModalViewMonth.gotoDate(displayDate);
                },
            },
            prevWeek: {
                text: "前週",
                click: function () {
                    displayDate.setDate(displayDate.getDate() - 7); //日付をアップデート
                    calendar.incrementDate({ days: -7 });
                    calendarModalViewMonth.gotoDate(displayDate);
                },
            },
            nextWeek: {
                text: "翌週",
                click: function () {
                    displayDate.setDate(displayDate.getDate() + 7); //日付をアップデート
                    calendar.incrementDate({ days: +7 });
                    calendarModalViewMonth.gotoDate(displayDate);
                },
            },
            nextMonth: {
                text: "翌月",
                click: function () {
                    displayDate.setMonth(displayDate.getMonth() + 1); //日付をアップデート
                    calendar.incrementDate({ months: 1 }); // 1ヶ月進める
                    calendarModalViewMonth.gotoDate(displayDate);
                },
            },
            openCalendar: {
                click: function () {
                    showDatePicker();
                },
            },
        },

        events: function (info, successCallback, failureCallback) {
            $.ajax({
                url: "/appointmentList/events",
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": window.csrf_token,
                },
                data: {
                    day: displayDate.getDate(),
                    month: displayDate.getMonth() + 1,
                    year: displayDate.getFullYear(),
                },
                dataType: "json",
                beforeSend: function () {
                    // 読み込み中が表示
                    window.showLoading();
                },
                complete: function () {
                    // 読み込み中が非表示
                    resetButtons();
                    window.hideLoading();
                },
                success: function (response) {
                    successCallback(response);
                },
                error: function (error) {
                    failureCallback(error);
                },
            });
        },

        eventDidMount: function (info) {
            switch (info.event._def.extendedProps.type) {
                case "break":
                    $(info.el)
                        .addClass("break")
                        .find(".fc-event-title")
                        .empty();
                    break;

                case "reserved":
                    $(info.el)
                        .addClass("reserved")
                        .find(".fc-event-title")
                        .empty()
                        // .append('<i class="fa-solid fa-x"></i>');
                        .append("✖");
                    break;

                case "unreserved":
                    $(info.el)
                        .addClass("unreserved")
                        .find(".fc-event-title")
                        .empty()
                        // .append('<i class="fa-regular fa-circle"></i>');
                        .append("〇");
                    break;

                default:
                    break;
            }
        },

        eventClick: function (info) {
            // 何もしない（遷移を防ぐ）
            if (
                info.event._def.extendedProps.type === "reserved" ||
                info.event._def.extendedProps.type === "break"
            ) {
                return;
            }

            // 過去の時間
            const startDate = new Date(info.event.start);
            const currentDate = new Date();
            if (startDate < currentDate) {
                alert("過去の時間ので予約できません。");
                return;
            }
            const selectedStore =
                document.querySelector('input[name="store"]:checked')?.value ||
                "";
            const selectedinspection_type =
                document.querySelector('input[name="inspection_type"]:checked')
                    ?.value || "";
            const selectedcustomer_type =
                document.querySelector('input[name="customer_type"]:checked')
                    ?.value || "";
            const selectedwork_type =
                document.querySelector('input[name="work_type"]:checked')
                    ?.value || "";
            const selectedreservation_task_id =
                document.querySelector(
                    'input[name="reservation_task_id"]:checked'
                )?.value || "";

            const selectedDateTime = info.event.start;
            const japanTime = moment(selectedDateTime).format(
                "YYYY-MM-DDTHH:mm:ss.SSS[Z]"
            );

            const formData = new FormData();
            formData.append("store", selectedStore);
            formData.append("inspection_type", selectedinspection_type);
            formData.append("customer_type", selectedcustomer_type);
            formData.append("work_type", selectedwork_type);
            formData.append("reservation_task_id", selectedreservation_task_id);
            formData.append("appointmentDateTime", japanTime);

            $.ajax({
                url: "/reservation/process",
                type: "POST",
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    window.showLoading();
                },
                complete: function () {},
                success: function (response) {
                    // リダイレクト
                    window.location.href =
                        window.location.href.replace(/\/$/, "") +
                        "/reservation/entry/" +
                        response.process_id; // 遷移先URL
                },
                error: function (xhr, status, error) {
                    window.hideLoading();
                },
            });
        },

        eventMouseEnter: function (info) {
            // イベントにマウスが乗った時の処理
            var startDate = new Date(info.event.start); // 開始日時を取得
            var options = {
                weekday: "short",
                month: "numeric",
                day: "numeric",
                hour: "numeric",
                minute: "2-digit",
            };
            var formattedDate = startDate.toLocaleString("ja-JP", options); // 日本語形式にフォーマット

            // ツールチップを生成して表示
            var tooltip = document.createElement("div");
            tooltip.className = "fc-tooltip"; // カスタムスタイル用クラス
            tooltip.innerHTML = formattedDate;
            tooltip.style.position = "absolute";
            tooltip.style.backgroundColor = "#fff";
            tooltip.style.border = "1px solid #ddd";
            tooltip.style.padding = "5px";
            tooltip.style.boxShadow = "0px 4px 6px rgba(0, 0, 0, 0.1)";
            tooltip.style.zIndex = "1000";
            tooltip.style.pointerEvents = "none";

            document.body.appendChild(tooltip);

            info.el.addEventListener("mousemove", function (event) {
                // ツールチップの位置をマウスの上に中央に配置
                var tooltipWidth = tooltip.offsetWidth;
                var tooltipHeight = tooltip.offsetHeight;

                // ツールチップの位置を中央に配置
                tooltip.style.left = event.pageX - tooltipWidth / 2 + "px"; // X軸で中央揃え
                tooltip.style.top = event.pageY - tooltipHeight - 10 + "px"; // Y軸で上に配置
            });

            info.el.tooltip = tooltip; // イベント要素にツールチップを紐付け
        },

        eventMouseLeave: function (info) {
            // イベントからマウスが離れた時の処理
            if (info.el.tooltip) {
                document.body.removeChild(info.el.tooltip); // ツールチップを削除
                info.el.tooltip = null;
            }
        },
    });
    calendar.render(); //メインカレンダーに表示

    // 新しいカレンダーを作成
    var calendarModalViewMonth = new FullCalendar.Calendar(
        document.getElementById("calendarModalViewMonth"),
        {
            initialView: "dayGridMonth", // 月間
            locale: "ja", // 日本語
            fixedWeekCount: false, //表示される週の数が変動
            height: 300,
            headerToolbar: {
                left: "prev",
                center: "title",
                right: "next",
            },

            dateClick: function (info) {
                var selectedDate = info.dateStr; // クリックされた日付
                displayDate = new Date(selectedDate); //日付をアップデート
                calendar.gotoDate(selectedDate); // 選択した日付に移動
                closeDatePicker(); // ポップアップを閉じる
            },

            // カレンダーの日付表示を消す
            dayCellContent: function (info) {
                return { html: info.date.getDate() }; // 日付セルに日付のみ表示
            },

            validRange: function (nowDate) {
                return {
                    start: nowDate,
                };
            },
        }
    );

    // カレンダー選択ボタンがクリックされた時にポップアップカレンダーを表示
    function showDatePicker() {
        // var modal = document.getElementById("calendarModal"); // モーダルを取得
        var modal = $("#calendarModal");
        modal.addClass("flex").removeClass("hidden");

        calendarModalViewMonth.render(); // 新しいカレンダーを描画
    }

    // ポップアップを閉じる関数
    function closeDatePicker() {
        $("#calendarModal").find(".btn--close-modal").trigger("click");
    }

    window.initialLoadedIcons = true;

    function resetButtons() {
        const starOfWeekDate = getStartOfWeek(displayDate);
        const starOfMonthDate = getStartOfMonth(displayDate);
        const currentDate = new Date();

        if (starOfWeekDate < currentDate) {
            $(".fc-prevWeek-button").each(function (e) {
                $(this).prop("disabled", true);
            });
        } else {
            $(".fc-prevWeek-button").each(function (e) {
                $(this).prop("disabled", false);
            });
        }
        if (starOfMonthDate < currentDate) {
            $(".fc-prevMonth-button").each(function (e) {
                $(this).prop("disabled", true);
            });
        } else {
            $(".fc-prevMonth-button").each(function (e) {
                $(this).prop("disabled", false);
            });
        }
    }

    function getStartOfWeek(date) {
        const givenDate = new Date(date);

        const dayOfWeek = givenDate.getDay();

        const diffToMonday = (dayOfWeek === 0 ? -6 : 1) - dayOfWeek;

        givenDate.setDate(givenDate.getDate() + diffToMonday);

        givenDate.setHours(0, 0, 0, 0);

        return givenDate;
    }

    function getStartOfMonth(date) {
        const givenDate = new Date(date);

        // Set the date to the 1st of the current month
        givenDate.setDate(1);

        // Set the time to the start of the day (00:00:00)
        givenDate.setHours(0, 0, 0, 0);

        return givenDate;
    }
});
