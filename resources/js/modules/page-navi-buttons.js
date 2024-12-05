window.isConfirmed = [];
window.currentPage = 0;

window.gotoPrev = function () {
    console.log("gotoprev");
    if (window.currentPage > 0) {
        window.currentPage--; // Go to previous page
        window.isConfirmed[window.currentPage] = false;
        updatePages();
    }
};
window.gotoNext = function () {
    console.log("gotonext", window.isConfirmed);
    if (window.isConfirmed[window.currentPage]) {
        if (window.currentPage < $pages.length - 1) {
            window.currentPage++; // Go to next page
            updatePages();
        }
    }
};

const $pages = $(".page"); // Get all pages (divs)
const $prevButton = $("#button-prev");
const $nextButton = $("#button-next");
const $submitButton = $("#button-submit");

// Function to update the visibility of pages
function updatePages() {
    // Hide all pages
    $pages.addClass("hidden").removeClass("block");

    // Show the current page
    $pages.eq(window.currentPage).addClass("block").removeClass("hidden");

    // Update button visibility
    updateButtons();
}

// Function to update the buttons based on current page
function updateButtons() {
    if (window.currentPage === 0) {
        // first page
        $prevButton.parent().addClass("hidden").removeClass("block"); // Hide prev on first page
        $submitButton.parent().addClass("hidden").removeClass("block"); // Hide submit until last page
        $nextButton.parent().addClass("block").removeClass("hidden"); // Show next
    } else if (window.currentPage === $pages.length - 1) {
        // middle page(s)
        $prevButton.parent().addClass("block").removeClass("hidden"); // Show prev on last page
        $submitButton.parent().addClass("block").removeClass("hidden"); // Show submit on last page
        $nextButton.parent().addClass("hidden").removeClass("block"); // Hide next on last page
    } else {
        // last page
        $prevButton.parent().addClass("block").removeClass("hidden"); // Show prev on middle pages
        $nextButton.parent().addClass("block").removeClass("hidden"); // Show next on middle pages
        $submitButton.parent().addClass("hidden").removeClass("block"); // Hide submit until last page
    }
}

// Event listeners for buttons
$prevButton.on("click", function (e) {
    e.preventDefault();
    window.gotoPrev();
});

$nextButton.on("click", function (e) {
    e.preventDefault();
    // window.isConfirmed is a variable from other js such as modules/auth/register.js files to check if they can proceed or not
    // usually used to submit a form request to validate form then proceed to confirmation page
    window.gotoNext();
});

$submitButton.on("click", function (e) {
    e.preventDefault();
    console.log("Form Submitted!");
});

// Initialize form to show the first page
updatePages();
