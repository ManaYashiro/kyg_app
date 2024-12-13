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
$(document).ready(function () {
    $(window).scroll(function () {
        doScroll();
    });

    $("#pagetop").on("click", function (e) {
        console.log("clicked");
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

    // 削除アラートメッセージ
    $(".delete--model").on("click", function (e) {
        e.preventDefault();

        var deleteModel = $(this).closest(".form-delete--model");
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

    window.confirmFormData = function (formData) {
        // Hide options
        $(".isOption").addClass("hidden").removeClass("block");
        let questionnaireIds = [];
        let questionnaireText = "";
        let questionnaireList = $("#confirm-questionnaire-list").data("list");

        for (var data of formData.entries()) {
            const key = data[0].replace(/[\[\]]/g, "");
            const val = data[1];

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
                $("#confirm-" + key + " span").text("*".repeat(val.length));

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
                // List from DB

                if (!questionnaireIds.includes(val)) {
                    questionnaireIds.push(val);
                    if (questionnaireText !== "") {
                        questionnaireText += "； ";
                    }
                    questionnaireText += window.findObjectByKeyValue(
                        questionnaireList,
                        "id",
                        val
                    ).name;
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

    window.findObjectByKeyValue = function (obj, key, value) {
        return obj.find((item) => item[key].toString() === value.toString());
    };
});
