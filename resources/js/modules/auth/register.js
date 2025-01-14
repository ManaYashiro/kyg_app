$(document).ready(function () {
    const $formUserRegister = $("#form-user-register");
    const $errors = $(".text-error");
    const $formUserRegisterPages = $(".page");
    const $btnPrev = $("#button-prev");
    const $btnNext = $("#button-next");
    const $btnSubmit = $("#button-submit");
    const $submitType = $("#submit-type");

    const formActionUrl = $formUserRegister.attr("action");
    const formMethod = $formUserRegister.attr("method");
    $btnPrev.on("click", function (e) {
        e.preventDefault();
        $("#password").val("");
        $("#password_confirmation").val("");
        $submitType.val("confirm");
    });
    $btnNext.on("click", function (e) {
        e.preventDefault();
        const formData = new FormData($formUserRegister[0]);

        // Trigger form validation
        if ($formUserRegister[0].checkValidity()) {
            // If the form is valid, submit via AJAX
            registerConfirm(
                formActionUrl,
                formMethod,
                formData,
                $submitType,
                $errors
            );
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
