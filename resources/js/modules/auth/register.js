$(document).ready(function () {
    const $formUserRegister = $("#form-user-register");
    const $errors = $(".text-error");
    const $formUserRegisterPages = $(".page");
    const $btnPrev = $("#button-prev");
    const $btnNext = $("#button-next");
    const $btnSubmit = $("#button-submit");
    const $formType = $("#form-type");

    const formActionUrl = $formUserRegister.attr("action");
    const formMethod = $formUserRegister.attr("method");
    $btnPrev.on("click", function (e) {
        e.preventDefault();
        $("#password").val("");
        $("#password_confirmation").val("");
        $formType.val("confirm");
    });
    $btnNext.on("click", function (e) {
        e.preventDefault();
        const formData = new FormData($formUserRegister[0]);

        // Trigger form validation
        if ($formUserRegister[0].checkValidity()) {
            // If the form is valid, submit via AJAX
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
                    console.log("Success:", response);
                    $formType.val("submit"); // ready for submit

                    window.confirmFormData(formData);

                    // go to next page
                    window.isConfirmed[window.currentPage] = true;
                    window.gotoNext();
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach((key, index) => {
                            const $err = $("#error-" + key);
                            $err.removeClass("hidden");
                            if (index === 0) {
                                $("html, body").animate(
                                    {
                                        scrollTop:
                                            $("#container-" + key).offset()
                                                .top - 10,
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
        } else {
            // If the form is not valid, trigger the browser's validation message
            $formUserRegister[0].reportValidity();
        }
    });
    $btnSubmit.on("click", function (e) {
        e.preventDefault();
        $formUserRegister.submit();
    });
});
