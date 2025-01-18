$(document).ready(function () {
    // 1. 予約作成（車検・点検）
    createReservation();

    // 3. 予約キャンセル（車検・点検）
    cancelReservation();

    // 5. カレンダー取得（車検・点検）
    calendarReservation();

    // 2. 予約作成（用品_Web）
    createReservationIncSupplies();

    // 4. 予約キャンセル（用品_Web）
    cancelReservationIncSupplies();

    // 6. カレンダー取得（用品_Web）
    calendarReservationIncSupplies();

    // 8. 予約ステータス変更
    acceptReservation();

    // 9. 予約キャンセル
    deleteReservation();

    // 10. 予約情報変更
    updateReservation();
});

function appendUrl(url, param) {
    // Get the first key in the object
    const key = Object.keys(param)[0];

    // Access the value using the key
    const value = param[key];

    const encodedParam = `${key}=${encodeURIComponent(value)}`;

    if (!url.includes("?")) {
        // first URL param
        return `?${encodedParam}`;
    } else {
        // succeeding URL param
        return `&${encodedParam}`;
    }
}

function createReservation() {
    const url = `/api/inspection/reservations`;
    const formData = new FormData();
    formData.append("workDiv", 1);
    formData.append("startTime", 202412251300);
    formData.append("endTime", 202412251400);
    formData.append("baseCode", 42011);
    formData.append("number", "尾張小牧300と1672");
    formData.append("reservationNo", "S32021202412010001");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("create reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}

function cancelReservation() {
    const reservationNo = "W32021202412010001";
    const url = `/api/inspection/reservations/${reservationNo}`;
    const formData = new FormData();
    formData.append("_method", "DELETE");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("cancel reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}

function calendarReservation() {
    const workDiv = { workDiv: 5 };
    const workTime = { workTime: 30 };
    const startDate = { startDate: 20250110 };
    const baseCode = { baseCode: 42011 };
    const isKeepTire = { isKeepTire: 1 };

    let baseUrl = `/api/inspection/calendar`;
    baseUrl += appendUrl(baseUrl, workDiv);
    baseUrl += appendUrl(baseUrl, workTime);
    baseUrl += appendUrl(baseUrl, startDate);
    baseUrl += appendUrl(baseUrl, baseCode);
    baseUrl += appendUrl(baseUrl, isKeepTire);

    const url = baseUrl;

    $.ajax({
        url: url,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("fetch calendar reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}

function createReservationIncSupplies() {
    const url = `/api/supplies/reservations`;
    const formData = new FormData();
    formData.append("workDiv", 1);
    formData.append("workSubDiv", 1);
    formData.append("startTime", 202412251300);
    formData.append("endTime", 202412251400);
    formData.append("baseCode", 42011);
    formData.append("kanji", "仁戸田");
    formData.append("carName", "アウトバック");
    formData.append("number", "尾張小牧300と1672");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("create reservation with supplies", response);
        },
        error: function (xhr, status, error) {},
    });
}

function cancelReservationIncSupplies() {
    const reservationNo = "W32021202412010001";
    const url = `/api/supplies/reservations/${reservationNo}`;
    const formData = new FormData();
    formData.append("_method", "DELETE");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("cancel reservation with supplies", response);
        },
        error: function (xhr, status, error) {},
    });
}

function calendarReservationIncSupplies() {
    const workDiv = { workDiv: 1 };
    const workSubDiv = { workSubDiv: 1 };
    const startDate = { startDate: 20250110 };
    const baseCode = { baseCode: 42011 };

    let baseUrl = `/api/supplies/calendar`;
    baseUrl += appendUrl(baseUrl, workDiv);
    baseUrl += appendUrl(baseUrl, workSubDiv);
    baseUrl += appendUrl(baseUrl, startDate);
    baseUrl += appendUrl(baseUrl, baseCode);

    const url = baseUrl;

    $.ajax({
        url: url,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("fetch calendar reservation with supplies", response);
        },
        error: function (xhr, status, error) {},
    });
}

function acceptReservation() {
    const url = `/api/reservations/accept`;
    const formData = new FormData();
    formData.append("reservationNo", "S32021202412010001");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("accept reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}

function deleteReservation() {
    const reservationNo = "W32021202412010001";
    const url = `/api/reservations/${reservationNo}`;
    const formData = new FormData();
    formData.append("_method", "DELETE");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("delete reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}

function updateReservation() {
    const url = `/api/reservations/update`;
    const formData = new FormData();
    formData.append("reservationNo", "S32021202412010001");
    formData.append("workDay", 20241225);
    formData.append("startTime", 1300);
    formData.append("endTime", 1400);

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log("update reservation", response);
        },
        error: function (xhr, status, error) {},
    });
}
