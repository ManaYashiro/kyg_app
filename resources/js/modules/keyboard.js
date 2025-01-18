$(document).ready(function () {
    //キーボード制御
    // 半角英数字のみを入力できるように制限
    $(".validateAlphanumeric").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^a-zA-Z0-9]/g, ""));
    });

    // 半角数字のみを入力できるように制限
    $(".validateNumeric").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^0-9]/g, ""));
    });
});
