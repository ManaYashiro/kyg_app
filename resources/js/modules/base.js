window.navi = function () {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem("dark")) {
            return JSON.parse(window.localStorage.getItem("dark"));
        }

        // else return their preferences
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem("dark", value);
    }

    return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark;
            setThemeToLocalStorage(this.dark);
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false;
        },
        isProfileMenuOpen: false,
        isProfileMenuToggled: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
            this.isProfileMenuToggled = true;
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false;
            this.isProfileMenuToggled = false;
        },
        shouldCloseProfileMenu() {
            if (this.isProfileMenuToggled) {
                this.isProfileMenuToggled = false;
            } else {
                this.closeProfileMenu();
            }
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen;
        },
        // Modal
        isModalOpen: false,
        trapCleanup: null,
        openModal() {
            this.isModalOpen = true;
            this.trapCleanup = focusTrap(document.querySelector("#modal"));
        },
        closeModal() {
            this.isModalOpen = false;
            this.trapCleanup();
        },
    };
};
window.showLoading = function () {
    $("#loading-screen").addClass("flex").removeClass("hidden");
};
window.hideLoading = function () {
    $("#loading-screen").addClass("hidden").removeClass("flex");
};
window.findObjectByKeyValue = function (obj, key, value) {
    return obj.find((item) => item[key].toString() === value.toString());
};
$(document).ready(function () {
    // Scroll top function start
    $(window).scroll(function () {
        doScroll();
    });

    $("#pagetop").on("click", function (e) {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            500
        );
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
