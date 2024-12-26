window.navi = function () {
    return {
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
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
    };
};
