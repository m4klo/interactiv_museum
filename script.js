// Wait for the page to finish loading before running the code
window.addEventListener('load', function() {
    // Get the curtain elements
    var curtainLeft = document.querySelector('.curtain-left');
    var curtainRight = document.querySelector('.curtain-right');

    // Add the 'open' class to the curtain elements to open them by default
    curtainLeft.classList.add('open');
    curtainRight.classList.add('open');
});

