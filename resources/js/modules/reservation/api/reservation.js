$(document).ready(function () {
    createReservation();
    createReservationIncSupplies();
    cancelReservation();
    cancelReservationIncSupplies();
    fetchCalendarReservation();
    fetchCalendarReservationIncSupplies();
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

function fetchCalendarReservation() {
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

function fetchCalendarReservationIncSupplies() {
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
