$(document).ready(function () {
    const $errors = $(".text-error");

    $("#reservation-submit--form").on("submit", function (e) {
        e.preventDefault();

        var urlParams = new URLSearchParams(window.location.search);

        // Fetch the value of the query parameter 'process_id'
        var processId = urlParams.get("process_id");

        // Create a new FormData object from the form
        var formData = new FormData(this);
        formData.append("process_id", processId);
        formData.append("target", "confirm");

        $.ajax({
            url: "/reservation/process",
            type: "POST",
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                $errors.empty().addClass("hidden");
                window.showLoading();
            },
            complete: function () {},
            success: function (response) {
                // リダイレクト
                window.location.href = response.redirectUrl;
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach((key, index) => {
                        const errKey = key.replace(/\./g, "_");
                        const $err = $("#error-" + errKey);
                        $err.removeClass("hidden");
                        errors[key].forEach((err) => {
                            $err.append("<li>" + err + "</i>");
                        });
                    });
                }
                window.hideLoading();
            },
        });
    });
});
