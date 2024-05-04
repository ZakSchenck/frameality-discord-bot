// Conditionally displays Header buttons based on screen width reactively
function checkWidth() {
    const headerLink = document.querySelectorAll('.header__link');
    const headerLinkImg = document.querySelector('.header__small-btn-container');
    windowWidth = 746;
    if (window.innerWidth < windowWidth) {
        headerLink.forEach((link) => link.style.display = 'none');
        headerLinkImg.style.display = 'block';
    } else {
        headerLink.forEach((link) => link.style.display = 'block');
        headerLinkImg.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // ON LOAD it checks width of screen
    checkWidth();

    // ON SCREEN CHANGE, run check width
    window.addEventListener('resize', checkWidth);
});