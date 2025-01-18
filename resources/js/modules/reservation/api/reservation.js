$(document).ready(function () {
    createReservation();
    createReservationIncSupplies();
    cancelReservation();
});

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
