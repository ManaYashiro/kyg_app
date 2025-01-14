window.showLoading = function () {
    $("#loading-screen").addClass("flex").removeClass("hidden");
};
window.hideLoading = function () {
    $("#loading-screen").addClass("hidden").removeClass("flex");
};
window.findObjectByKeyValue = function (obj, key, value) {
    return obj.find((item) => item[key].toString() === value.toString());
};
window.scrollToTopPage = function () {
    $("html, body").animate(
        {
            scrollTop: 0,
        },
        500
    );
};
$(document).ready(function () {
    // Scroll top function start
    $(window).scroll(function () {
        doScroll();
    });

    $("#pagetop").on("click", function (e) {
        window.scrollToTopPage();
    });

    function doScroll() {
        var scrollPosition = $(window).scrollTop();
        var pageTop = $("#pagetop");
        if (scrollPosition >= 50) {
            if (pageTop.hasClass("invisible")) {
                pageTop
                    .removeClass("invisible")
                    .fadeIn("slow")
                    .addClass("fixed");
                doScroll();
            }
        } else {
            if (pageTop.hasClass("fixed")) {
                pageTop.fadeOut("slow", function () {
                    pageTop.removeClass("fixed").addClass("invisible");
                    doScroll();
                });
            }
        }
    }
    // Scroll top function end

    // close modal button
    $(".btn--close-modal").on("click", function () {
        $(this).closest(".modal").addClass("hidden").removeClass("flex block");
    });

    // 削除アラートメッセージ
    $(".delete--model").on("click", function (e) {
        e.preventDefault();

        var deleteModel = $("#form-delete--model");
        let modelTitle = deleteModel.data("title");

        Swal.fire({
            title: "「" + modelTitle + "」を削除してもよろしいですか?",
            text: "これを元に戻すことはできません！",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "はい",
            cancelButtonText: "いいえ",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteModel.attr("action"),
                    method: deleteModel.attr("method"),
                    data: deleteModel.serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "削除しました！",
                                text: response.message,
                                icon: "success",
                            }).then(() => {
                                window.location.href = response.redirectUrl;
                            });
                        } else {
                            // Show error message if deletion fails
                            Swal.fire({
                                title: "エラー！",
                                text: "削除に失敗しました。再試行してください。",
                                icon: "error",
                            });
                        }
                    },
                    error: function () {
                        // Handle any AJAX errors
                        Swal.fire({
                            title: "エラー！",
                            text: "サーバーへのリクエストに失敗しました。",
                            icon: "error",
                        });
                    },
                });
            }
        });
    });
});
