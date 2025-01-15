let site_flag = null;
let inspection_type = null;
let work_type = null;
let customer_type = null;
let has_tire_storage = null;
let reservation_task_id = null;

let user_select_data = {};

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
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
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
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
            `,
        },
        3: {
            name: "刈谷店",
            details: `
                【営業時間】月～土9：00～18：00 日祝日9：00～17：00<br>
                【定休日】水曜日<br>
                【所在地】〒448-0006　愛知県刈谷市西境町治右田140<br>
                【TEL】0120-41-4507<br>
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
            `,
        },
        4: {
            name: "錦店",
            details: `
                【営業時間】9：00～18：00<br>
                【定休日】日曜・祝日<br>
                【所在地】〒460-0003　愛知県名古屋市錦3-8-32<br>
                【TEL】0120-74-0045<br>
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
            `,
        },
        5: {
            name: "豊田上郷店",
            details: `
                【営業時間】月～土9：00～18：00 日祝日9：00～17：00<br>
                【定休日】水曜日<br>
                【所在地】〒470-1213 愛知県豊田市桝塚西町南小畔52-1<br>
                【TEL】0120-74-0045<br>
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
            `,
        },
        6: {
            name: "犬山店",
            details: `
                【営業時間】9：00～18：00<br>
                【定休日】水曜日<br>
                【所在地】〒470-1213 愛知県刈犬山市字舟田10<br>
                【TEL】0120-83-2244<br>
                [詳細URL]<a href="http://carlife-service.com/store.html" target="_blank" class="text-blue-500 underline">http://carlife-service.com/store.html</a>
            `,
        },
    };

    // 詳細ボタンのクリックイベント
    $(".step01-details").on("click", function () {
        const storeId = $(this).data("store-id");
        const store = storeInfo[storeId];

        if (store) {
            // store_idに応じた特定のモーダルを表示
            $(`#modalTitle${storeId}`).text(`${store.name} の店舗情報`);
            $(`#modalContent${storeId}`).html(store.details);
            $(`#storeModal${storeId}`).removeClass("hidden");
            hideCalendar();
        }
    });

    // 各モーダルの閉じるボタンのイベント
    $("[id^=closeModal]").on("click", function () {
        const modalId = $(this).closest("[id^=storeModal]").attr("id");
        $(`#${modalId}`).addClass("hidden");
    });

    // スクロールアイコン（#scrollbar）がクリックされたとき
    $("#scrollbar").on("click", function () {
        // #step01の位置にスムーズにスクロールする
        $("html, body").animate(
            {
                scrollTop: $("#step01").offset().top,
            },
            800
        ); // 800はスクロールの所要時間（ミリ秒）
    });

    $(".step-radio").on("click", function () {
        disableTireStorageOption(this);

        let stepKey = $(this).attr("name");

        switch (stepKey) {
            case "store":
                site_flag = "site_flag_" + $(this).data("site-name");
                break;
            case "inspection_type":
                inspection_type = $(this).val();
                break;
            case "work_type":
                work_type = $(this).val();
                break;
            case "customer_type":
                customer_type = $(this).val();
                break;
            case "reservation_task_id":
                reservation_task_id = $(this).val();
                break;

            default:
                break;
        }

        user_select_data = {
            site_flag,
            inspection_type,
            work_type,
            customer_type,
            reservation_task_id,
        };
        enableTireStorageOption();
        showWorkType(user_select_data);
        showReservationTasks(user_select_data);
    });
});

function showWorkType(user_select_data) {
    let workTypeItems = $("div.work-type-item");

    workTypeItems
        .filter(function () {
            return filterWorkTypes(this, user_select_data);
        })
        .removeClass("hidden")
        .end()
        .filter(function () {
            return !filterWorkTypes(this, user_select_data);
        })
        .addClass("hidden");
}

function showReservationTasks(user_select_data) {
    let reservationTaskItems = $("div.reservation-task-item");

    reservationTaskItems
        .filter(function () {
            return filterReservationTasks(this, user_select_data);
        })
        .removeClass("hidden")
        .end()
        .filter(function () {
            return !filterReservationTasks(this, user_select_data);
        })
        .addClass("hidden");
}

function filterWorkTypes(elementData, user_select_data) {
    if (
        user_select_data.site_flag === null ||
        user_select_data.inspection_type === null ||
        user_select_data.customer_type === null
    ) {
        return false;
    }
    var $this = $(elementData);
    var $type = $this.data("type");
    if (user_select_data.inspection_type === "車検") {
        // 車検
        return $type === "車検";
    } else {
        // 点検整備・見積り・その他
        return $type !== "車検";
    }
}

function filterReservationTasks(elementData, user_select_data) {
    var $this = $(elementData);
    var $elementData = $this.data("user_select_data");
    var site_flag = user_select_data.site_flag;

    return (
        // compare all objects
        compareData($elementData, user_select_data) &&
        // filter by site_flag
        $elementData[site_flag] == "1"
    );
    // return isDeepEqual($elementData, user_select_data);
}

function disableTireStorageOption(element) {
    var $this = $(element);
    $("input[name='has_tire_storage']").each(function () {
        $(this).prop("disabled", true);
    });
    if ($this.attr("name") != "has_tire_storage") {
        $("input[name='has_tire_storage']:checked").each(function () {
            $(this).prop("checked", false);
        });
    }
}

function enableTireStorageOption() {
    var $this = $("input[name='reservation_task_id']:checked");
    if ($this.length > 0) {
        var reservationTaskContainer = $this.closest(".reservation-task-item");
        var has_tire_storage =
            reservationTaskContainer.data("user_select_data").has_tire_storage;
        if (has_tire_storage != "") {
            $("input[name='has_tire_storage']").each(function () {
                $(this).prop("disabled", false);
            });
        }
    }
}

function compareData(elementData, user_select_data) {
    if (user_select_data.inspection_type === "車検") {
        // 車検
        return (
            elementData.inspection_type === "車検" &&
            elementData.work_type === user_select_data.work_type &&
            elementData.customer_type === user_select_data.customer_type
        );
    } else {
        // 点検整備・見積り・その他
        return (
            elementData.inspection_type !== "車検" &&
            elementData.work_type === user_select_data.work_type &&
            elementData.customer_type === user_select_data.customer_type
        );
    }
}

// only compare keys that exist on both objects and its corresponding value
function partialEqual(elementData, user_select_data) {
    // Get the keys of both objects
    const keys1 = Object.keys(elementData);
    const keys2 = Object.keys(user_select_data);

    // Get the common keys between both objects
    const commonKeys =
        Object.keys(keys1).length >= Object.keys(keys2).length
            ? keys1.filter((key) => keys2.includes(key))
            : keys2.filter((key) => keys1.includes(key));

    // Check if values for the common keys are the same
    return commonKeys.every(
        (key) => elementData[key] === user_select_data[key]
    );
}

// two objects are deeply identical
function isDeepEqual(elementData, user_select_data) {
    if (elementData === user_select_data) {
        return true; // Same reference or both are primitive values
    }

    if (
        typeof elementData !== "object" ||
        typeof user_select_data !== "object" ||
        elementData === null ||
        user_select_data === null
    ) {
        return false; // If one is null or not an object, they are not equal
    }

    const keys1 = Object.keys(elementData);
    const keys2 = Object.keys(user_select_data);

    if (keys1.length !== keys2.length) {
        return false; // Different number of keys
    }

    // Check if all keys and values are equal
    for (let key of keys1) {
        if (
            !keys2.includes(key) ||
            !isDeepEqual(elementData[key], user_select_data[key])
        ) {
            return false; // If key is missing or values are different
        }
    }

    return true; // All checks passed, objects are equal
}

function hideCalendar() {
    $("#calendar-container").find(".fc-view-harness").css("z-index", "0");
}

function showCalendar() {
    $("#calendar-container").find(".fc-view-harness").css("z-index", "unset");
}

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
    $('input[name="inspection_type"]').on("change", function () {
        var selectedcategoryValue = $(this).val();
        $("#selectedinspection_type").val(selectedcategoryValue); // 隠しフィールドに選択された値を設定
    });
    // チェックボックスが選択された時
    $(document).on("click", 'input[name="reservation_task_id"]', function () {
        var selectedreservationtaskValue = $(this).val();
        $("#selectedreservation_task_id").val(selectedreservationtaskValue); // 隠しフィールドに選択された値を設定
    });

    // ラジオボタンが選択された時
    $('input[name="work_type"]').on("change", function () {
        var selectedwork_typeValue = $(this).val();
        $("#selectedwork_type").val(selectedwork_typeValue); // 隠しフィールドに選択された値を設定
    });
});
