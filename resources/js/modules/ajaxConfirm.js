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
            window.showLoading();
        },
        complete: function () {
            window.hideLoading();
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
window.confirmFormData = function (formData) {
    // Hide options
    $(".isOption").addClass("hidden").removeClass("block");
    let questionnaireIds = [];
    let questionnaireText = "";
    let questionnaireList = $("#confirm-questionnaire-list").data("list");

    let carSequence = 0;

    for (var data of formData.entries()) {
        // change array key from laravel validaton to string key
        const key = data[0].replace(/[\[\]]/g, "");
        const val = data[1];

        if (key === "car_name") {
            carSequence++;
            if (val !== "") {
                $("#confirm-" + key + "_" + carSequence + " span")
                    .closest(".isConfirm")
                    .removeClass("hidden")
                    .addClass("block");
            }
        }

        if (val === null || val === "") {
            // skip iteration user did not add any data
            continue;
        }

        // Clear text
        $("#confirm-" + key + " span").text("");

        // Insert text
        if (key === "password") {
            // password

            // Show password as asterisks
            $("#confirm-" + key + " span").text("*".repeat(10));

            // Show container of option
            $("#confirm-" + key + " span")
                .closest(".isConfirm")
                .removeClass("hidden")
                .addClass("block");
        } else if (
            key === "gender" ||
            key === "call_time" ||
            key === "is_receive_newsletter" ||
            key === "is_receive_notification"
        ) {
            // ENUM based values

            // All text are loaded and will be displayed only on the selected item
            $("#confirm-" + key + "-" + val)
                .addClass("block")
                .removeClass("hidden");

            // Show container of option
            $("#confirm-" + key + "-" + val)
                .closest(".isConfirm")
                .addClass("block")
                .removeClass("hidden");
        } else if (key === "questionnaire") {
            $("#confirm-questionnaire-list")
                .closest(".isConfirm")
                .addClass("block")
                .removeClass("hidden");

            // List from DB
            if (!questionnaireIds.includes(val)) {
                questionnaireIds.push(val);
                if (questionnaireText !== "") {
                    questionnaireText += "； ";
                }
                questionnaireText += window.findObjectByKeyValue(
                    questionnaireList,
                    "name",
                    val
                ).name;
            }
        } else if (key.startsWith("car")) {
            if (val !== "") {
                if (key.startsWith("car_class")) {
                    const car_class_key = "#confirm-car_class_" + carSequence;
                    const car_class_list_key =
                        "#confirm-car_class-list_" + carSequence;
                    const car_class_list = $(car_class_list_key).data("list");
                    const car_list_text = window.findObjectByKeyValue(
                        car_class_list,
                        "id",
                        val
                    ).name;
                    $(car_class_key + " span").text(car_list_text);
                } else {
                    $("#confirm-" + key + "_" + carSequence + " span").text(
                        val
                    );
                }
            }
        } else {
            // Other inputs for confirmation

            // Show text
            $("#confirm-" + key + " span").text(val);

            // Show container of option
            $("#confirm-" + key + " span")
                .closest(".isConfirm")
                .removeClass("hidden")
                .addClass("block");
        }
    }
    // questionnaire text after looping through formData
    $("#confirm-questionnaire span").text(questionnaireText);
};
