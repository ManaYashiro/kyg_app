$(document).ready(function () {
    createReservation();
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
