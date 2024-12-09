document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar"); //ID要素を取得
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "timeGridWeek", //週間
        locale: "ja", //日本語
        height: "auto", //高さの自動調整
        allDaySlot: false, //終日

        headerToolbar: {
            //ヘッダー要素にボタン/カスタムボタンを追加する
            right: "prevMonth prev next nextMonth", //右側にボタンを追加
            left: "today calendarSelect", //左側にボタンを追加
        },

        slotMinTime: "09:00:00", //開始時間
        slotMaxTime: "19:00:00", //終了時間
        slotDuration: "01:00:00", //時間の区切り

        slotLabelFormat: {
            hour: "numeric", //時刻を数字で表示
            minute: "2-digit", //分を2桁で表示
            omitZeroMinute: false, //0分も00と表示
        },

        buttonText: {
            //ボタン名表記
            today: "直近の状況",
            prev: "<前週",
            next: "翌週>",
        },

        customButtons: {
            //カスタムボタン追加
            prevMonth: {
                text: "<<前月",
                click: function () {
                    calendar.incrementDate({ months: -1 }); // 1ヶ月戻る
                },
            },
            nextMonth: {
                text: "翌月>>",
                click: function () {
                    calendar.incrementDate({ months: 1 }); // 1ヶ月進める
                },
            },
            calendarSelect: {
                text: "カレンダー選択",
                click: function () {
                    showDatePicker();
                },
            },
        },

        events: [
            // カレンダーに表示するイベントを定義
            {
                title: "〇",
                start: "2024-12-02T10:00:00",
                end: "2024-12-02T11:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "〇",
                start: "2024-12-02T13:00:00",
                end: "2024-12-02T14:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "✕",
                start: "2024-12-02T14:00:00",
                end: "2024-12-02T15:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "✕",
                start: "2024-12-03T14:00:00",
                end: "2024-12-03T15:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "✕",
                start: "2024-12-04T13:00:00",
                end: "2024-12-04T14:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "✕",
                start: "2024-12-04T14:00:00",
                end: "2024-12-04T15:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "✕",
                start: "2024-12-04T15:00:00",
                end: "2024-12-04T16:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "〇",
                start: "2024-12-05T15:00:00",
                end: "2024-12-05T16:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "〇",
                start: "2024-12-05T16:00:00",
                end: "2024-12-05T17:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
            {
                title: "〇",
                start: "2024-12-05T17:00:00",
                end: "2024-12-05T18:00:00",
                textColor: "#0000ff",
                backgroundColor: "#ffffff",
            },
        ],

        eventClick: function (info) {
            if (info.event.title === "✕") {
                return; // 何もしない（遷移を防ぐ）
            }
            window.location.href =
                window.location.href.replace(/\/$/, "") + "/reservation/entry"; // 遷移先URL
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

    // カレンダー選択ボタンがクリックされた時にポップアップカレンダーを表示
    function showDatePicker() {
        var modal = document.getElementById("calendarModal"); // モーダルを取得
        console.log(modal);
        if (modal) {
            modal.style.display = "flex"; // 既存のモーダルがあれば表示
        } else {
            // モーダル要素がなければ新規作成
            modal = document.createElement("div");
            modal.id = "calendarModal";
            modal.style.position = "fixed";
            modal.style.top = "0";
            modal.style.left = "0";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
            modal.style.display = "flex";
            modal.style.alignItems = "center";
            modal.style.justifyContent = "center";
            modal.style.zIndex = "9999";

            var popup = document.createElement("div");
            popup.style.backgroundColor = "white";
            popup.style.padding = "20px";
            popup.style.borderRadius = "8px";
            popup.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
            popup.innerHTML = '<div id="calendarPopup"></div>';
            modal.appendChild(popup);
            document.body.appendChild(modal); // モーダルをDOMに追加
        }

        // 既存のカレンダーを削除（もしあれば）
        var existingPopup = document.getElementById("calendarPopup");
        if (existingPopup) {
            existingPopup.innerHTML = ""; // コンテンツをクリア
        }

        // 新しいカレンダーを作成
        var calendarPopup = new FullCalendar.Calendar(
            document.getElementById("calendarPopup"),
            {
                initialView: "dayGridMonth", // 月間
                locale: "ja", // 日本語
                fixedWeekCount: false, //表示される週の数が変動
                headerToolbar: {
                    left: "prev",
                    center: "title",
                    right: "next",
                },

                dateClick: function (info) {
                    var selectedDate = info.dateStr; // クリックされた日付
                    calendar.gotoDate(selectedDate); // 選択した日付に移動
                    closeDatePicker(); // ポップアップを閉じる
                },

                // カレンダーの日付表示を消す
                dayCellContent: function (info) {
                    return { html: info.date.getDate() }; // 日付セルに日付のみ表示
                },
            }
        );

        calendarPopup.render(); // 新しいカレンダーを描画
    }

    // ポップアップを閉じる関数
    function closeDatePicker() {
        var modal = document.getElementById("calendarModal");
        modal.style.display = "none"; // モーダルを非表示にする
    }
});
