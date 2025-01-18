$(document).ready(function () {
    inspectReservation();
});

function inspectReservation() {
    const formData = new FormData();
    const reservationNo = "here";
    formData.append("_method", "DELETE");

    const url = `/api/test`;

    console.log(url);

    $.ajax({
        // url: `/api/reservations/${reservationNo}`,
        url: url,
        // type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function () {},
        complete: function () {},
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {},
    });
}
