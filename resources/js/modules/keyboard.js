$(document).ready(function () {
    //キーボード制御
    // 半角英数字のみを入力できるように制限
    $(".validateAlphanumeric").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^a-zA-Z0-9@._+-]/g, ""));
    });

    // 半角数字のみを入力できるように制限
    $(".validateNumeric").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^0-9/]/g, ""));
    });

    //半角かなのみ入力できるように制限
    $(".validateKana").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^\u30A0-\u30FF\uFF61-\uFF9F]/g, ""));
    });

    //かなのみ入力できるように制限
    $(".validateHKana").on("input", function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^ぁ-ん]/g, ""));
    });
});
