// Wait for the page to finish loading before running the code
window.addEventListener('load', function() {
    // Get the curtain elements
    var curtainLeft = document.querySelector('.curtain-left');
    var curtainRight = document.querySelector('.curtain-right');

    // Add the 'open' class to the curtain elements to open them by default
    curtainLeft.classList.add('open');
    curtainRight.classList.add('open');
});


function generateGallery(pageNum, checkedAuthors) {
    // Pobranie wartości zaznaczonych autorów, stylów oraz lokalizacji
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
            selectedAuthors: checkedAuthors,
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

function generatePageButtons(totalPages) {
    let container = document.getElementById('pageButtonsContainer');
    container.innerHTML = '';
  
    let currentPage = 1;
    let maxButtons = 10;
  
    if (totalPages <= maxButtons) {
    for (let i = 1; i <= totalPages; i++) {
        createPageButton(i, currentPage);
    }
    } else {
      let startPage = currentPage;
      let endPage = startPage + maxButtons - 1;
  
    if (endPage > totalPages) {
        endPage = totalPages;
        startPage = endPage - maxButtons + 1;
    }
  
    for (let i = startPage; i <= endPage; i++) {
        createPageButton(i);
    }
    }
  
    container.classList.remove('hidden');
    container.style.textAlign = 'center';
  }
  
function createPageButton(pageNumber) {
    let button = document.createElement('button');
    button.textContent = pageNumber;
    button.classList.add('page-button');
  
    button.addEventListener('click', function () {
        if(pageNum!=pageNumber){
            animateGalleryTransition('animate-from-bottom');
            animateButtonsTransition('animate-from-bottom');
            setTimeout(function() {
                generateGallery(pageNumber);
                pageNum=pageNumber;
            }, 2000);
        }
    });
  
    let container = document.getElementById('pageButtonsContainer');
    container.appendChild(button);
}
  
function generateAuthors(searchTerm, checkedAuthors) {
    $.ajax({
        url: 'generate_authors.php',
        type: 'GET',
        data: { search: searchTerm, checkedAuthors: checkedAuthors },
        success: function(response) {
            // Zaktualizuj zawartość okna modalnego zwróconą przez plik generate_authors.php
            $('#authorList').html(response);
        }
    });
}
function getCheckedAuthors(checkedAuthors) {
    // Pobierz zaznaczone checkboxy
    $('.form-check-input').each(function() {
        const authorId = $(this).val();
        const authorIndex = checkedAuthors.indexOf(authorId);

        if ($(this).is(':checked')) {
            // Dodaj autora do listy, jeśli jeszcze go tam nie ma
            if (authorIndex === -1) {
                checkedAuthors.push(authorId);
            }
        } else {
            // Usuń autora z listy, jeśli jest na liście
            if (authorIndex !== -1) {
                checkedAuthors.splice(authorIndex, 1);
            }
        }
    });

    return checkedAuthors;
}
