document.addEventListener('DOMContentLoaded', function() {

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

    checkWidth();

    window.addEventListener('resize', checkWidth);
});