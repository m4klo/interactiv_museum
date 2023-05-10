// Wait for the page to finish loading before running the code
window.addEventListener('load', function() {
    // Get the curtain elements
    var curtainLeft = document.querySelector('.curtain-left');
    var curtainRight = document.querySelector('.curtain-right');

    // Add the 'open' class to the curtain elements to open them by default
    curtainLeft.classList.add('open');
    curtainRight.classList.add('open');
});

function generateGallery(pageNum) {
    // Pobranie wartości zaznaczonych autorów, stylów oraz lokalizacji
    const selectedAuthors = $('#authorModal [type=checkbox]:checked').map(function() {
        return $(this).val();
    }).get();
    
    const selectedStyles = $('#styleModal [type=checkbox]:checked').map(function() {
        return $(this).val();
    }).get();
    
    const selectedLocations = $('#locationModal [type=checkbox]:checked').map(function() {
        return $(this).val();
    }).get();

    // Wysłanie zapytania AJAX do generate_gallery.php z wybranymi autorami, stylami oraz lokalizacjami jako dane POST
    $.ajax({
        url: 'generate_gallery.php',
        type: 'POST',
        data: {
            selectedAuthors: selectedAuthors,
            selectedStyles: selectedStyles,
            selectedLocations: selectedLocations,
            pageNum: pageNum
        },
        success: function(html) {
            // Uaktualnienie zawartości galerii na stronie
            $('#gallery').html(html);
        }
    });

}
$(window).on('beforeunload', function() {
    $.ajax({
        type: 'GET',
        url: 'logout.php', // Twój skrypt PHP, który wywołuje session_destroy()
        async: false // Zatrzymuje wykonywanie skryptu, aż zostanie zakończone żądanie AJAX
    });
});

