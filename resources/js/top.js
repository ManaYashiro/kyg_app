$(document).ready(function () {
    // Ajaxでデータを取得
    $.ajax({
        url: "/gettaskdata",
        method: "GET",
        success: function (response) {
            const taskCategoryData = response.task_category;
            const taskReservationData = response.task_reservation;

            const storeCategories = {
                稲沢本店: [1, 2, 3],
                名古屋北店: [1, 4, 3],
                刈谷店: [5, 3],
                錦店: [5, 3],
                豊田上郷店: [5, 3],
                犬山店: [5, 3],
            };

            const taskReservation = {
                "車検（00分開始）": [1, 2],
                "車検（30分開始）": [4, 3],
                "車検（30分開始）土曜のみ": [4, 3],
                車検: [5, 6],
                "点検整備・車検見積り": [
                    7, 8, 9, 10, 11, 12, 13, 15, 19, 20, 21, 22, 23, 24,
                ],
                "点検整備・車検見積り": [
                    7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
                    23, 24,
                ],
                "点検整備・車検見積り": [
                    7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
                    23, 24,
                ],
            };

            const taskinfo = {
                "★個人★車検ラビット４５（00分開始）（60分）": {
                    name: "予約する作業情報",
                    details: `
                        【★個人★車検ラビット４５（00分開始）（60分）<br>
                        お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。車検は満期日の３０日前から受けられます。
                    `,
                },
                "☆法人☆ご来店型クイック車検（00分開始）（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆ご来店型クイック車検（00分開始）（60分）<br>
                        お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。車検は満期日の３０日前から受けられます。
                    `,
                },
                "★個人★車検ラビット４５（30分開始）（60分）": {
                    name: "予約する作業情報",
                    details: `
                        【★個人★車検ラビット４５（30分開始）（60分）<br>
                        お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。車検は満期日の３０日前から受けられます。
                    `,
                },
                "☆法人☆ご来店型クイック車検（30分開始）（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆ご来店型クイック車検（30分開始）（60分）<br>
                        お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。車検は満期日の３０日前から受けられます。
                    `,
                },
                "★個人★車検見積り（30分）": {
                    name: "予約する作業情報",
                    details: `
                        ★個人★車検見積り（30分）<br>
                        車検の事前見積りです。車検時に必要な整備や部品交換の料金をご提示します。
                    `,
                },
                "☆法人☆スケジュール点検（30分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆スケジュール点検（30分）<br>
                        メンテナンス契約で定めたサイクルで行う点検です。所要時間は約30分程度です。
                    `,
                },
                "★☆法人☆スケジュール点検＋タイヤ付替え（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆スケジュール点検＋タイヤ付替え（60分）<br>
                        メンテナンス契約で定めたサイクルで行う点検と一緒にタイヤ交換を行います。所要時間は約60分程度です。
                    `,
                },
                "★個人★12ヶ月点検（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ★個人★12ヶ月点検（60分）<br>
                        運転者の義務として法律で定められた点検です。前回の点検（車検・1年点検）から12ヶ月後が点検の目安です。所要時間は約60分程度です。
                    `,
                },
                "☆法人☆スケジュール点検＋タイヤ付替え（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆スケジュール点検＋タイヤ付替え（60分）<br>
                        メンテナンス契約で定めたサイクルで行う点検と一緒にタイヤ交換を行います。所要時間は約60分程度です。
                    `,
                },
                "☆法人☆12ヶ月点検（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆12ヶ月点検（60分）<br>
                        運転者の義務として法律で定められた点検です。前回の点検（車検・1年点検）から12ヶ月後が点検の目安です。所要時間は約60分程度です。
                    `,
                },
                "☆法人☆6ヶ月点検（60分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆6ヶ月点検（60分）
                        運転者の義務として法律で定められた点検です。前回の点検（車検・1年点検）から6ヶ月後が点検の目安です。所要時間は約60分程度です。
                    `,
                },
                "★個人★タイヤ付替え[ホイール付](30分)": {
                    name: "予約する作業情報",
                    details: `
                        ★個人★タイヤ付替え[ホイール付](30分)<br>
                        タイヤとホイールがセットされている状態の場合は、こちらをお選びください。
                    `,
                },
                "☆法人☆タイヤ付替え[ホイール付](30分)": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆タイヤ付替え[ホイール付](30分)<br>
                        タイヤとホイールがセットされている状態の場合は、こちらをお選びください。
                    `,
                },
                "★個人★エンジンオイル交換（30分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆エンジンオイル交換（30分）<br>
                        定期的なオイル交換はエンジンの調子を保ち、燃費の悪化を防ぐために重要です。3,000~5,000kmまたは半年ごとの交換をお勧めします。
                    `,
                },
                "☆法人☆エンジンオイル交換（30分）": {
                    name: "予約する作業情報",
                    details: `
                        ☆法人☆エンジンオイル交換（30分）<br>
                        定期的なオイル交換はエンジンの調子を保ち、燃費の悪化を防ぐために重要です。5,000kmまたは半年ごとの交換をお勧めします。
                    `,
                },
            };

            // 店舗選択に応じて作業カテゴリを更新する関数
            function updateTaskCategories(store) {
                // $("#taskCategories").empty();
                if (storeCategories.hasOwnProperty(store)) {
                    const taskIds = storeCategories[store];
                    const filteredCategories = taskCategoryData
                        .filter((category) => taskIds.includes(category.id))
                        .sort(
                            (a, b) =>
                                taskIds.indexOf(a.id) - taskIds.indexOf(b.id)
                        );

                    let categoryIndex = 0;
                    filteredCategories.forEach((category, index) => {
                        // ボタン表示
                        $("#taskCategories")
                            .find("#task-category-label-" + (index + 1))
                            .removeClass("hidden");

                        // ボタンテキストを変更
                        $("#taskCategories")
                            .find("#task-category-span-" + (index + 1))
                            .text(`${category.category_name}`);

                        // バリューを変更
                        $("#taskCategories")
                            .find("#task-category-input-" + (index + 1))
                            .val(`${category.category_name}`);
                        categoryIndex = index + 1;
                    });

                    for (let i = categoryIndex; i <= 3; i++) {
                        // ボタン表示
                        $("#taskCategories")
                            .find("#task-category-label-" + (categoryIndex + 1))
                            .addClass("hidden");
                    }
                } else {
                    console.log(
                        "Error: store key does not exist in storeCategories."
                    );
                }
            }

            // タスク予約を更新する関数
            function updateReservationTasks(taskCategory, customerType) {
                $("#reservationTasks").empty(); // 既存のタスクをクリア

                // taskReservationオブジェクトを参照
                if (taskReservation.hasOwnProperty(taskCategory)) {
                    const taskIds = taskReservation[taskCategory];
                    taskReservationData
                        .filter((task) => taskIds.includes(task.id)) // 選択したカテゴリのIDに一致するタスクをフィルタ
                        .forEach((task) => {
                            const taskHTML = `
                                <div class="flex space-x-4 mt-4 items-center text-xs font-bold mx-10 task-item">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="reservationtask" value="${task.reservation_name}">
                                        <span>${task.reservation_name}</span>
                                    </label>
                                    <div class="font-bold p-4 text-xs text-left grow"></div>
                                    <div class="details-button2 text-red-600 font-bold px-2 text-right inline-block border-b border-red-600 cursor-pointer"
                                    data-task-id="${task.reservation_name}" id="showDetailsBtn">さらに詳しく</div>
                                </div>
                                <hr class="my-3 border-1 border-red-300 mx-10 task-divider">
                            `;
                            $("#reservationTasks").append(taskHTML);
                        });

                    $("#reservationTasks")
                        .children(".task-item")
                        .each(function () {
                            const taskItem = $(this);
                            const taskDivider = taskItem.next(".task-divider");
                            const taskName = taskItem.find("span").text();

                            if (taskName.includes("メンテパック")) {
                                taskItem.removeClass("hidden-task");
                                taskDivider.removeClass("hidden-task");
                            } else if (
                                customerType === "0" &&
                                !taskName.includes("★個人★")
                            ) {
                                taskItem.addClass("hidden-task");
                                taskDivider.addClass("hidden-task");
                            } else if (
                                customerType === "1" &&
                                !taskName.includes("☆法人☆")
                            ) {
                                taskItem.addClass("hidden-task");
                                taskDivider.addClass("hidden-task");
                            } else {
                                taskItem.removeClass("hidden-task");
                                taskDivider.removeClass("hidden-task");
                            }
                        });
                } else {
                    console.log(
                        "Error: taskCategory key does not exist in taskReservation."
                    );
                }
            }
            // 初期表示
            updateTaskCategories("稲沢本店");

            // 店舗ラジオボタンが変更された時に作業カテゴリを更新
            $('input[name="store"]').on("change", function () {
                const selectedStore = $(this).val();
                updateTaskCategories(selectedStore);
            });

            // 作業カテゴリのラジオボタンが変更された時に予約作業を更新
            $(document).on("change", 'input[name="taskcategory"]', function () {
                const selectedTaskCategory = $(this).val();
                const selectedCustomerType = $(
                    'input[name="customer"]:checked'
                ).val(); // 個人または法人の選択
                updateReservationTasks(
                    selectedTaskCategory,
                    selectedCustomerType
                );
            });

            // 個人・法人ラジオボタンが変更された時に予約作業を更新
            $('input[name="customer"]').on("change", function () {
                const selectedTaskCategory = $(
                    'input[name="taskcategory"]:checked'
                ).val(); // 現在選択されている作業カテゴリ
                const selectedCustomerType = $(this).val();
                updateReservationTasks(
                    selectedTaskCategory,
                    selectedCustomerType
                );
            });

            $(document).on("click", ".details-button2", function () {
                const taskId = $(this).data("task-id"); // 修正した data-task-id 属性を取得
                const task = taskinfo[taskId]; // taskId で taskinfo オブジェクトを参照
                if (task) {
                    console.log(task);
                    $("#modalTitle2").empty().text(`${task.name} `);
                    console.log(`${task.name} `);
                    $("#modalContent2").html(task.details);
                    console.log(task.details);
                    $("#reservationModal").removeClass("hidden");
                }
            });

            // モーダルを閉じる
            $(document).on("click", "#closeModal", function () {
                $("#reservationModal").addClass("hidden");
            });
        },
        error: function (error) {
            console.log("データの取得に失敗しました", error);
        },
    });
});

$(document).ready(function () {
    $('input[name="reservationtask"]').on("change", function () {
        // チェックされた場合、他のチェックボックスのチェックを外す
        $('input[name="reservationtask"]').not(this).prop("checked", false);
    });
});

$(document).ready(function () {
    // スクロールアイコン（#scrollbar）がクリックされたとき
    $("#scrollbar").on("click", function () {
        // #stepの位置にスムーズにスクロールする
        $("html, body").animate(
            {
                scrollTop: $("#step").offset().top,
            },
            800
        ); // 800はスクロールの所要時間（ミリ秒）
    });
});

$(document).ready(function () {
    // 店舗情報データ
    const storeInfo = {
        1: {
            name: "稲沢本店",
            details: `
                【営業時間】9：00～19：00<br>
                【定休日】水曜日<br>
                【所在地】〒492-8224　愛知県稲沢市奥田大沢町3-1<br>
                【TEL】0120-63-0045<br>
                愛知県稲沢市にある車検・整備・カー用品の専門店です。<br>
                車検・整備・鈑金塗装・ボディーコーティング・タイヤ・ナビオーディオ等の取付ピットは60基以上！
                自動車販売や保険も含めたトータルカーサービスで地域の皆様のカーライフをサポートいたします。<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
        2: {
            name: "名古屋北店",
            details: `
                【営業時間】月～土9：00～18：00<br>
                【定休日】日曜・祝日<br>
                【所在地】〒462-0034　愛知県名古屋市北区天道町5丁目21<br>
                【TEL】0120-85-0045<br>
                名古屋市北区・西区での車検ならオートプラザラビット名古屋北店にお任せください。<br>
                車検・整備・ポリマー加工・自動車保険・板金塗装にいたるまで、一級整備士を含む国家資格整備士が多数在籍していますので、安心してお車をお任せいただけます。
                ハイブリットカーの整備もお任せください。<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
        3: {
            name: "刈谷店",
            details: `
                【営業時間】月～土9：00～18：00 日祝日9：00～17：00<br>
                【定休日】水曜日<br>
                【所在地】〒448-0006　愛知県刈谷市西境町治右田140<br>
                【TEL】0120-41-4507<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
        4: {
            name: "錦店",
            details: `
                【営業時間】9：00～18：00<br>
                【定休日】日曜・祝日<br>
                【所在地】〒460-0003　愛知県名古屋市錦3-8-32<br>
                【TEL】0120-74-0045<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
        5: {
            name: "豊田上郷店",
            details: `
                【営業時間】月～土9：00～18：00 日祝日9：00～17：00<br>
                【定休日】水曜日<br>
                【所在地】〒470-1213 愛知県豊田市桝塚西町南小畔52-1<br>
                【TEL】0120-74-0045<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
        6: {
            name: "犬山店",
            details: `
                【営業時間】9：00～18：00<br>
                【定休日】水曜日<br>
                【所在地】〒470-1213 愛知県刈犬山市字舟田10<br>
                【TEL】0120-83-2244<br>
                <a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">詳細はこちら</a>
            `,
        },
    };

    // 詳細ボタンのクリックイベント
    $(".details-button").on("click", function () {
        const storeId = $(this).data("store-id"); // 店舗IDを取得
        console.log(storeId);
        const store = storeInfo[storeId]; // 店舗情報を取得

        if (store) {
            $("#modalTitle").text(`${store.name} の店舗情報`);
            $("#modalContent").html(store.details);
            $("#storeModal").removeClass("hidden");
        }
    });

    // モーダルを閉じる
    $("#closeModal").on("click", function () {
        $("#storeModal").addClass("hidden");
    });
});
