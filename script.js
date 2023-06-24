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
function generateMobileGallery(pageNum, checkedAuthors, checkedCenturies, checkedLocations) {
    // Wysłanie zapytania AJAX do generate_mobile_gallery.php z wybranymi autorami, stylami oraz lokalizacjami jako dane POST
    $.ajax({
        url: 'generate_mobile_gallery.php',
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
function generatePhoneGallery(pageNum, checkedAuthors, checkedCenturies, checkedLocations) {
    // Wysłanie zapytania AJAX do generate_mobile_gallery.php z wybranymi autorami, stylami oraz lokalizacjami jako dane POST
    $.ajax({
        url: 'generate_phone_gallery.php',
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
        url: 'logout.php',
        async: false
    });
});

function generatePageButtons(totalPages, currentPage) {
    let container = document.getElementById('pageButtonsContainer');
    container.innerHTML = '';

    let maxButtons = 9;
    let endPage = 0;

    if (totalPages <= maxButtons) {
        for (let i = 1; i <= totalPages; i++) {
            createPageButton(i, currentPage);
        }
    } else {
        let startPage = Math.max(1, currentPage - 4);
        if (currentPage > 5) {
            endPage = Math.min(totalPages, currentPage + 4);
        } else {
            endPage = 9;
        }
        if (startPage > 1) {
            createEndButtons("<<", currentPage, totalPages);
        }

        for (let i = startPage; i <= endPage; i++) {
            createPageButton(i, currentPage);
        }

        if (endPage < totalPages) {
            createEndButtons(">>", currentPage, totalPages);
        }
    }

    container.classList.remove('hidden');
    container.style.textAlign = 'center';
}
  
  function createPageButton(pageNumber, currentPage) {
    let button = document.createElement('button');
    button.textContent = pageNumber;
    button.classList.add('page-button');
  
    if (pageNumber === currentPage) {
      button.classList.add('active');
    }
  
    button.addEventListener('click', function () {
      if (pageNumber !== currentPage) {
        animateGalleryTransition('animate-from-bottom');
        animateButtonsTransition('animate-from-bottom');
        setTimeout(function () {
            if (width <= 1200 && width > 1024) {
                generateMobileGallery(pageNumber, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else if(width <= 1024){
                generatePhoneGallery(pageNumber, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else {
                generateGallery(pageNumber, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
          pageNum = pageNumber;
        }, 2000);
      }
    });
  
    let container = document.getElementById('pageButtonsContainer');
    container.appendChild(button);
}
function createEndButtons(sign, pageNumber, totalPages) {
    let button = document.createElement('button');
    button.textContent = sign;
    button.classList.add('page-button');
    button.setAttribute('data-total-pages', totalPages);
  
    button.addEventListener('click', function () {
      let currentPage = pageNumber;
      let totalPages = parseInt(this.getAttribute('data-total-pages'));
  
      if (sign === "<<") {
        if (currentPage !== 1) {
          animateGalleryTransition('animate-from-bottom');
          animateButtonsTransition('animate-from-bottom');
          setTimeout(function () {
            if (width <= 1200 && width > 1024) {
                generateMobileGallery(1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else if(width <= 1024){
                generatePhoneGallery(1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else {
                generateGallery(1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
          pageNum = pageNumber;
            pageNum = 1;
          }, 2000);
        }
      }
      if (sign === ">>") {
        if (currentPage !== totalPages) {
          animateGalleryTransition('animate-from-bottom');
          animateButtonsTransition('animate-from-bottom');
          setTimeout(function () {
            if (width <= 1200 && width > 1024) {
                generateMobileGallery(totalPages, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else if(width <= 1024){
                generatePhoneGallery(totalPages, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else {
                generateGallery(totalPages, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
          pageNum = totalPages;
          }, 2000);
        }
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
            if (authorIndex === -1) {
                checkedAuthors.push(authorId);
            }
        } else {
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
            if (centuryIndex === -1) {
                checkedCenturies.push(centuryId);
            }
        } else {
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
            if (locationIndex === -1) {
                checkedLocations.push(locationId);
            }
        } else {
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
            $('#register_location').html(response);
        }
    });
}
function getVerificationTable(){
    $.ajax({
        type: 'GET',
        url: 'generate_verification_table.php',
        success: function(response) {
            $('#verification-table').html(response);
        }
    });
} 
let currentWidthNum = getScreenWidthNum();

window.addEventListener('resize', function() {
  const newWidthNum = getScreenWidthNum();
  
  if (currentWidthNum !== newWidthNum) {
    currentWidthNum = newWidthNum;
    location.reload();
  }
});

function getScreenWidthNum() {
  const width = $(window).width();

  if (width > 1200) {
    return 3;
  } else if (width <= 1200 && width > 1024) {
    return 2;
  } else {
    return 1;
  }
}