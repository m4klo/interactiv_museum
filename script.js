function generateGallery(pageNum, checkedAuthors, checkedCenturies, checkedLocations) {
// Wysłanie zapytania AJAX do generate_gallery.php z wybranymi autorami, stylami oraz lokalizacjami jako dane POST
    $.ajax({
        url: 'generate_gallery.php',
        type: 'POST',
        data: {
            selectedAuthors: checkedAuthors,
            selectedcenturies: checkedCenturies,
            selectedLocations: checkedLocations,
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
                generateGallery(pageNumber, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
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

function generateCenturies(searchTerm, checkedCenturies) {
    $.ajax({
        url: 'generate_centuries.php',
        type: 'GET',
        data: { search: searchTerm, checkedCenturies: checkedCenturies },
        success: function(response) {
            // Zaktualizuj zawartość okna modalnego zwróconą przez plik generate_authors.php
            $('#centuryList').html(response);
        }
    });
}

function generateLocations(searchTerm, checkedLocations) {
    $.ajax({
        url: 'generate_locations.php',
        type: 'GET',
        data: { search: searchTerm, checkedLocations: checkedLocations },
        success: function(response) {
            // Zaktualizuj zawartość okna modalnego zwróconą przez plik generate_authors.php
            $('#locationList').html(response);
        }
    });
}
function getCheckedAuthors(checkedAuthors) {
    // Pobierz zaznaczone checkboxy
    $('#authorModal .form-check-input').each(function() {
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
function getCheckedCenturies(checkedCenturies) {
    // Pobierz zaznaczone checkboxy
    $('#centuryModal .form-check-input').each(function() {
        const centuryId = $(this).val();
        const centuryIndex = checkedCenturies.indexOf(centuryId);

        if ($(this).is(':checked')) {
            // Dodaj autora do listy, jeśli jeszcze go tam nie ma
            if (centuryIndex === -1) {
                checkedCenturies.push(centuryId);
            }
        } else {
            // Usuń autora z listy, jeśli jest na liście
            if (centuryIndex !== -1) {
                checkedCenturies.splice(centuryIndex, 1);
            }
        }
    });

    return checkedCenturies;
}
function getCheckedLocations(checkedLocations) {
    // Pobierz zaznaczone checkboxy
    $('#locationModal .form-check-input').each(function() {
        const locationId = $(this).val();
        const locationIndex = checkedLocations.indexOf(locationId);

        if ($(this).is(':checked')) {
            // Dodaj autora do listy, jeśli jeszcze go tam nie ma
            if (locationIndex === -1) {
                checkedLocations.push(locationId);
            }
        } else {
            // Usuń autora z listy, jeśli jest na liście
            if (locationIndex !== -1) {
                checkedLocations.splice(locationIndex, 1);
            }
        }
    });

    return checkedLocations;
}
function getLocations(){
    $.ajax({
        type: 'GET',
        url: 'generate_register_locations.php',
        success: function(response) {
            // Zaktualizuj zawartość okna modalnego zwróconą przez plik generate_authors.php
            $('#register_location').html(response);
        }
    });
}
function getVerificationTable(){
    $.ajax({
        type: 'GET',
        url: 'generate_verification_table.php',
        success: function(response) {
            // Zaktualizuj zawartość okna modalnego zwróconą przez plik generate_authors.php
            $('#verification-table').html(response);
        }
    });
}