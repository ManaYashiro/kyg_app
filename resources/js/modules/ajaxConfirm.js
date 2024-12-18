window.ajaxConfirm = function (
    formActionUrl,
    formMethod,
    formData,
    $submitType,
    $errors
) {
    $.ajax({
        url: formActionUrl,
        type: formMethod,
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $errors.empty().addClass("hidden");
        },
        success: function (response) {
            // ready for submit
            $submitType.val("submit");

            window.confirmFormData(formData);

            // go to next page
            window.isConfirmed[window.currentPage] = true;
            window.gotoNext();
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach((key, index) => {
                    // fix keys for array, change `.` to `_`
                    const errKey = key.replace(/\./g, "_");
                    const $err = $("#error-" + errKey);
                    $err.removeClass("hidden");
                    if (index === 0) {
                        $("html, body").animate(
                            {
                                scrollTop:
                                    $("#container-" + key).offset().top - 10,
                            },
                            300
                        );
                    }
                    errors[key].forEach((err) => {
                        $err.append("<li>" + err + "</i>");
                    });
                });
            } else {
                console.log("Error:", status);
                console.log("Error:", error);
            }
        },
    });
};
