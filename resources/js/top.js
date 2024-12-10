$(document).ready(function () {
    const taskCategories = {
        // 各店舗の作業カテゴリ
        1: [
            { value: "車検_稲沢（00分開始）", text: "車検_稲沢（00分開始）" },
            { value: "車検_稲沢（30分開始）", text: "車検_稲沢（30分開始）" },
            {
                value: "点検整備・車検見積り_稲沢",
                text: "点検整備・車検見積り_稲沢",
            },
        ],
        2: [
            { value: "車検_名北（00分開始）", text: "車検_名北（00分開始）" },
            {
                value: "車検_名北（30分開始）土曜のみ",
                text: "車検_名北（30分開始）土曜のみ",
            },
            {
                value: "点検整備・車検見積り_名北",
                text: "点検整備・車検見積り_名北",
            },
        ],
        3: [
            { value: "車検_刈谷", text: "車検_刈谷" },
            {
                value: "点検整備・車検見積り_刈谷",
                text: "点検整備・車検見積り_刈谷",
            },
        ],
        4: [
            { value: "車検_錦", text: "車検_錦" },
            {
                value: "点検整備・車検見積り_錦",
                text: "点検整備・車検見積り_錦",
            },
        ],
        5: [
            { value: "車検_豊田", text: "車検_豊田" },
            {
                value: "点検整備・車検見積り_豊田",
                text: "点検整備・車検見積り_豊田",
            },
        ],
        6: [
            { value: "車検_犬山", text: "車検_犬山" },
            {
                value: "点検整備・車検見積り_犬山",
                text: "点検整備・車検見積り_犬山",
            },
        ],
    };

    const reservationTasks = {
        // 各店舗の作業対応したカテゴリ
        "車検_稲沢（00分開始）": [
            {
                value: "★個人★車検ラビット４５（00分開始）（60分）",
                text: "★個人★車検ラビット４５（00分開始）（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（00分開始）（60分）",
                text: "☆法人☆ご来店型クイック車検（00分開始）（60分）",
            },
        ],
        "車検_稲沢（30分開始）": [
            {
                value: "★個人★車検ラビット４５（30分開始）（60分）",
                text: "★個人★車検ラビット４５（30分開始）（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（30分開始）（60分）",
                text: "☆法人☆ご来店型クイック車検（30分開始）（60分）",
            },
        ],
        "車検_名北（00分開始）": [
            {
                value: "★個人★車検ラビット４５（00分開始）（60分）",
                text: "★個人★車検ラビット４５（00分開始）（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（00分開始）（60分）",
                text: "☆法人☆ご来店型クイック車検（00分開始）（60分）",
            },
        ],
        "車検_名北（30分開始）土曜のみ": [
            {
                value: "★個人★車検ラビット４５（30分開始）（60分）",
                text: "★個人★車検ラビット４５（30分開始）（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（30分開始）（60分）",
                text: "☆法人☆ご来店型クイック車検（30分開始）（60分）",
            },
        ],
        車検_刈谷: [
            {
                value: "★個人★車検ラビット４５（60分）",
                text: "★個人★車検ラビット４５（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（60分）",
                text: "☆法人☆ご来店型クイック車検（60分）",
            },
        ],
        車検_錦: [
            {
                value: "★個人★車検ラビット４５（60分）",
                text: "★個人★車検ラビット４５（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（60分）",
                text: "☆法人☆ご来店型クイック車検（60分）",
            },
        ],
        車検_豊田: [
            {
                value: "★個人★車検ラビット４５（60分）",
                text: "★個人★車検ラビット４５（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（60分）",
                text: "☆法人☆ご来店型クイック車検（60分）",
            },
        ],
        車検_犬山: [
            {
                value: "★個人★車検ラビット４５（60分）",
                text: "★個人★車検ラビット４５（60分）",
            },
            {
                value: "☆法人☆ご来店型クイック車検（60分）",
                text: "☆法人☆ご来店型クイック車検（60分）",
            },
        ],
        // 共通の点検整備・車検見積りの予約タスク
        "点検整備・車検見積り_稲沢": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
        "点検整備・車検見積り_名北": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆ユニカー点検（30分）",
                text: "☆法人☆ユニカー点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "★個人★タイヤ付替え[ホイール付](30分)",
                text: "★個人★タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "★個人★タイヤ付替え[タイヤのみ](60分）",
                text: "★個人★タイヤ付替え[タイヤのみ](60分）",
            },
            {
                value: "★個人★エンジンオイル交換（30分）",
                text: "★個人★エンジンオイル交換（30分）",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
        "点検整備・車検見積り_刈谷": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "★個人★タイヤ付替え[ホイール付](30分)",
                text: "★個人★タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "★個人★タイヤ付替え[タイヤのみ](60分）",
                text: "★個人★タイヤ付替え[タイヤのみ](60分）",
            },
            {
                value: "★個人★エンジンオイル交換（30分）",
                text: "★個人★エンジンオイル交換（30分）",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
        "点検整備・車検見積り_錦": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "★個人★タイヤ付替え[ホイール付](30分)",
                text: "★個人★タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "★個人★タイヤ付替え[タイヤのみ](60分）",
                text: "★個人★タイヤ付替え[タイヤのみ](60分）",
            },
            {
                value: "★個人★エンジンオイル交換（30分）",
                text: "★個人★エンジンオイル交換（30分）",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
        "点検整備・車検見積り_豊田": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "★個人★タイヤ付替え[ホイール付](30分)",
                text: "★個人★タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "★個人★タイヤ付替え[タイヤのみ](60分）",
                text: "★個人★タイヤ付替え[タイヤのみ](60分）",
            },
            {
                value: "★個人★エンジンオイル交換（30分）",
                text: "★個人★エンジンオイル交換（30分）",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
        "点検整備・車検見積り_犬山": [
            {
                value: "★個人★車検見積り（30分）",
                text: "★個人★車検見積り（30分）",
            },
            {
                value: "☆法人☆スケジュール点検（30分）",
                text: "☆法人☆スケジュール点検（30分）",
            },
            {
                value: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                text: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
            },
            {
                value: "★個人★12ヶ月点検（60分）",
                text: "★個人★12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆12ヶ月点検（60分）",
                text: "☆法人☆12ヶ月点検（60分）",
            },
            {
                value: "☆法人☆6ヶ月点検（60分）",
                text: "☆法人☆6ヶ月点検（60分）",
            },
            {
                value: "★個人★タイヤ付替え[ホイール付](30分)",
                text: "★個人★タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "☆法人☆タイヤ付替え[ホイール付](30分)",
                text: "☆法人☆タイヤ付替え[ホイール付](30分)",
            },
            {
                value: "★個人★タイヤ付替え[タイヤのみ](60分）",
                text: "★個人★タイヤ付替え[タイヤのみ](60分）",
            },
            {
                value: "★個人★エンジンオイル交換（30分）",
                text: "★個人★エンジンオイル交換（30分）",
            },
            {
                value: "☆法人☆エンジンオイル交換（30分）",
                text: "☆法人☆エンジンオイル交換（30分）",
            },
            {
                value: "メンテパック6ヶ月点検（30分）",
                text: "メンテパック6ヶ月点検（30分）",
            },
            {
                value: "メンテパック12ヶ月点検（60分）",
                text: "メンテパック12ヶ月点検（60分）",
            },
            {
                value: "メンテパック18ヶ月点検（30分）",
                text: "メンテパック18ヶ月点検（30分）",
            },
            {
                value: "メンテパック24ヶ月点検（60分）",
                text: "メンテパック24ヶ月点検（60分）",
            },
            {
                value: "メンテパック30ヶ月点検（30分）",
                text: "メンテパック30ヶ月点検（30分）",
            },
        ],
    };
    //店舗が選択された時
    $("#store").change(function () {
        const selectedStore = $(this).val();
        const taskCategorySelect = $("#taskcategory");

        // 作業カテゴリのオプションを初期化
        taskCategorySelect
            .empty()
            .append('<option value="">-- 選択してください --</option>');

        // 対応する作業カテゴリを追加
        if (taskCategories[selectedStore]) {
            taskCategories[selectedStore].forEach(function (taskcategory) {
                taskCategorySelect.append(
                    $("<option>", {
                        value: taskcategory.value,
                        text: taskcategory.text,
                    })
                );
            });
        }
    });

    // 作業カテゴリ選択時の予約タスク更新
    $("#taskcategory").change(function () {
        const selectedTaskCategory = $(this).val();
        const reservationTaskSelect = $("#reservationtask");

        // 予約タスクのオプションを初期化
        reservationTaskSelect
            .empty()
            .append('<option value="0">-- 選択してください --</option>');

        // 対応する予約タスクを追加
        if (reservationTasks[selectedTaskCategory]) {
            reservationTasks[selectedTaskCategory].forEach(function (
                reservationtask
            ) {
                reservationTaskSelect.append(
                    $("<option>", {
                        value: reservationtask.value,
                        text: reservationtask.text,
                    })
                );
            });
        }
    });
});

$(document).ready(function () {
    //店舗を選んで詳細押した店舗情報表示
    $("#storedetails").on("click", function () {
        // 選択された店舗のvalを取得
        const selectedValue = $("#store").val();
        const store = storeInfo[selectedValue];

        if (!store) {
            return; // 処理を終了
        }

        $("#modalTitle").text(`${store.name} の店舗情報`);

        // 店舗情報を表示
        $("#modalContent").html(`
            <p>${store.description.hours}</p>
            <p>${store.description.holiday}</p>
            <p>${store.description.address}</p>
            <p>${store.description.tel}</p>
            <p>${store.description.introduction}</p>
            <p>${store.description.url}</p>
        `);

        // モーダルを表示
        $("#storeModal").removeClass("hidden").addClass("flex");
    });

    $("#closeModal").on("click", function () {
        // モーダルを非表示
        $("#storeModal").addClass("hidden").removeClass("flex");
    });

    //店舗情報
    const storeInfo = {
        1: {
            name: "稲沢本店",
            description: {
                hours: "【営業時間】9：00～19：00",
                holiday: "【定休日】水曜日",
                address: "【所在地】〒492-8224　愛知県稲沢市奥田大沢町3-1",
                tel: "【TEL】0120-63-0045",
                introduction:
                    "愛知県稲沢市にある車検・整備・カー用品の専門店です。車検・整備・鈑金塗装・ボディーコーティング・タイヤ・ナビオーディオ等の取付ピットは60基以上！自動車販売や保険も含めたトータルカーサービスで地域の皆様のカーライフをサポートいたします。",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
        2: {
            name: "名古屋北店",
            description: {
                hours: "【営業時間】月～土9：00～18：00",
                holiday: "【定休日】日曜・祝日",
                address:
                    "【所在地】〒462-0034　愛知県名古屋市北区天道町5丁目21",
                tel: "【TEL】0120-85-0045",
                introduction:
                    "名古屋市北区・西区での車検ならオートプラザラビット名古屋北店にお任せください。車検・整備・ポリマー加工・自動車保険・板金塗装にいたるまで、一級整備士を含む国家資格整備士が多数在籍していますので、安心してお車をお任せいただけます。ハイブリットカーの整備もお任せください。",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
        3: {
            name: "刈谷店",
            description: {
                hours: "【営業時間】月～土9：00～18：00 日祝日9：00～17：00",
                holiday: "【定休日】水曜日",
                address: "【所在地】〒448-0006　愛知県刈谷市西境町治右田140",
                tel: "【TEL】0120-41-4507",
                introduction: "",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
        4: {
            name: "錦店",
            description: {
                hours: "【営業時間】9：00～18：00",
                holiday: "【定休日】日曜・祝日",
                address: "【所在地】〒460-0003　愛知県名古屋市錦3-8-32",
                tel: "【TEL】0120-74-0045",
                introduction: "",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
        5: {
            name: "豊田上郷店",
            description: {
                hours: "【営業時間】月～土9：00～18：00 日祝日9：00～17：00",
                holiday: "【定休日】水曜日日",
                address: "【所在地】〒470-1213 愛知県豊田市桝塚西町南小畔52-1",
                tel: "【TEL】0565-25-9058",
                introduction: "",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
        6: {
            name: "犬山店",
            description: {
                hours: "【営業時間】9：00～18：00",
                holiday: "【定休日】水曜日",
                address: "【所在地】〒484-0912　愛知県刈犬山市字舟田10",
                tel: "【TEL】0120-83-2244",
                introduction: "",
                url: "[詳細URL] http://carlife-service.com/store.html",
            },
        },
    };
});

$(document).ready(function () {
    //作業を選んで詳細押した作業情報表示
    $("#workdetails").on("click", function () {
        // 選択された作業のvalを取得
        const selectedValue = $("#taskcategory").val();
        const task = taskInfo[selectedValue];
        $("#modalTitle").text("作業カテゴリ情報");

        if (!task) {
            return; // 処理を終了
        }

        // 作業カテゴリ情報を表示
        $("#modalContent").html(`
            <p>${task.description.content}</p>
            <p>${task.description.namestore}</p>
            <p>${task.description.introduction}</p>
        `);

        // モーダルを表示
        $("#storeModal").removeClass("hidden").addClass("flex");
    });

    $("#closeModal").on("click", function () {
        // モーダルを非表示
        $("#storeModal").addClass("hidden").removeClass("flex");
    });

    //作業カテゴリ情報
    const taskInfo = {
        "車検_稲沢（00分開始）": {
            description: {
                content: "車検_稲沢（00分開始）",
                namestore: "[ご希望の店舗] 稲沢本店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        "車検_稲沢（30分開始）": {
            description: {
                content: "車検_稲沢（30分開始）",
                namestore: "[ご希望の店舗] 稲沢本店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        "車検_名北（00分開始）": {
            description: {
                content: "車検_名北（00分開始）",
                namestore: "[ご希望の店舗] 名古屋北店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        "車検_名北（30分開始）土曜のみ": {
            description: {
                content: "車検_名北（30分開始）土曜のみ",
                namestore: "[ご希望の店舗] 名古屋北店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        車検_刈谷: {
            description: {
                content: "車検_刈谷",
                namestore: "[ご希望の店舗] 錦店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        車検_錦: {
            description: {
                content: "車検_錦",
                namestore: "[ご希望の店舗] 錦店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        車検_豊田: {
            description: {
                content: "車検_豊田上郷",
                namestore: "[ご希望の店舗] 豊田上郷店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
        車検_犬山: {
            description: {
                content: "車検_犬山",
                namestore: "[ご希望の店舗] 犬山店",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。",
            },
        },
    };
});

$(document).ready(function () {
    //作業を選んで詳細押した作業情報表示
    $("#reservationdetails").on("click", function () {
        // 選択された作業のvalを取得
        const selectedValue = $("#reservationtask").val();
        const reservation = reservationInfo[selectedValue];

        if (!reservation) {
            return; // 処理を終了
        }

        $("#modalTitle").text("予約する作業情報");

        // 予約する作業情報を表示
        $("#modalContent").html(`
            <p>${reservation.description.content}</p>
            <p>${reservation.description.introduction}</p>
        `);

        // モーダルを表示
        $("#storeModal").removeClass("hidden").addClass("flex");
    });

    $("#closeModal").on("click", function () {
        // モーダルを非表示
        $("#storeModal").addClass("hidden").removeClass("flex");
    });

    //予約する作業情報
    const reservationInfo = {
        "★個人★車検ラビット４５（00分開始）（60分）": {
            description: {
                content: "★個人★車検ラビット４５（00分開始）（60分）",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。<br>車検は満期日の３０日前から受けられます。",
            },
        },
        "☆法人☆ご来店型クイック車検（00分開始）（60分）": {
            description: {
                content: "☆法人☆ご来店型クイック車検（00分開始）（60分）",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。<br>車検は満期日の３０日前から受けられます。",
            },
        },
        "★個人★車検ラビット４５（30分開始）（60分）": {
            description: {
                content: "★個人★車検ラビット４５（30分開始）（60分）",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。<br>車検は満期日の３０日前から受けられます。",
            },
        },
        "☆法人☆ご来店型クイック車検（30分開始）（60分）": {
            description: {
                content: "☆法人☆ご来店型クイック車検（30分開始）（60分）",
                introduction:
                    "お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。<br>車検は満期日の３０日前から受けられます。",
            },
        },
        //点検・見積もり
        "★個人★車検見積り（30分）": {
            description: {
                content: "★個人★車検見積り（30分）",
                introduction:
                    "車検の事前見積りです。車検時に必要な整備や部品交換の料金をご提示します。",
            },
        },
        "☆法人☆スケジュール点検（30分）": {
            description: {
                content: "☆法人☆スケジュール点検（30分）",
                introduction:
                    "メンテナンス契約で定めたサイクルで行う点検です。所要時間は約30分程度です。",
            },
        },
        "☆法人☆スケジュール点検＋タイヤ付替え（60分）": {
            description: {
                content: "☆法人☆スケジュール点検＋タイヤ付替え（60分）",
                introduction:
                    "メンテナンス契約で定めたサイクルで行う点検と一緒にタイヤ交換を行います。<br>所要時間は約60分程度です。",
            },
        },
        "★個人★12ヶ月点検（60分）": {
            description: {
                content: "★個人★12ヶ月点検（60分）",
                introduction:
                    "運転者の義務として法律で定められた点検です。<br>前回の点検（車検・1年点検）から12ヶ月後が点検の目安です。<br>所要時間は約60分程度です。",
            },
        },
        "☆法人☆12ヶ月点検（60分）": {
            description: {
                content: "☆法人☆12ヶ月点検（60分）",
                introduction:
                    "運転者の義務として法律で定められた点検です。<br>前回の点検（車検・1年点検）から12ヶ月後が点検の目安です。<br>所要時間は約60分程度です。",
            },
        },
        "☆法人☆6ヶ月点検（60分）": {
            description: {
                content: "☆法人☆6ヶ月点検（60分）",
                introduction:
                    "運転者の義務として法律で定められた点検です。<br>前回の点検（車検・1年点検）から12ヶ月後が点検の目安です。<br>所要時間は約60分程度です。",
            },
        },
        "★個人★タイヤ付替え[ホイール付](30分)": {
            description: {
                content: "★個人★タイヤ付替え[ホイール付](30分)",
                introduction:
                    "タイヤとホイールがセットされている状態の場合は、こちらをお選びください。",
            },
        },
        "☆法人☆タイヤ付替え[ホイール付](30分)": {
            description: {
                content: "☆法人☆タイヤ付替え[ホイール付](30分)",
                introduction:
                    "タイヤとホイールがセットされている状態の場合は、こちらをお選びください。",
            },
        },
        "★個人★タイヤ付替え[タイヤのみ](60分）": {
            description: {
                content: "★個人★タイヤ付替え[タイヤのみ](60分）",
                introduction:
                    "ホイールからタイヤを外し、別のタイヤを組み込む場合はこちらをお選びください。",
            },
        },
        "★個人★エンジンオイル交換（30分）": {
            description: {
                content: "★個人★エンジンオイル交換（30分）",
                introduction:
                    "定期的なオイル交換はエンジンの調子を保ち、燃費の悪化を防ぐために重要です。3,000~5,000kmまたは半年ごとの交換をお勧めします。",
            },
        },
        "☆法人☆エンジンオイル交換（30分）": {
            description: {
                content: "☆法人☆エンジンオイル交換（30分）",
                introduction:
                    "定期的なオイル交換はエンジンの調子を保ち、燃費の悪化を防ぐために重要です。5,000kmまたは半年ごとの交換をお勧めします。",
            },
        },
    };
});
