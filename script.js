// Wait for the page to finish loading before running the code
window.addEventListener('load', function() {
    // Get the curtain elements
    var curtainLeft = document.querySelector('.curtain-left');
    var curtainRight = document.querySelector('.curtain-right');

    // Add the 'open' class to the curtain elements to open them by default
    curtainLeft.classList.add('open');
    curtainRight.classList.add('open');
});

$(document).ready(function() {
    $('#applyAuthors').click(function() {
      // Pobieramy zaznaczone autorów z pól wyboru
      var selectedAuthors = $('input[name="author[]"]:checked').map(function(){
        return $(this).val();
      }).get();
      // Wykonujemy dowolne działania na podstawie wybranych autorów
      console.log(selectedAuthors);
      // Zamykamy modal
      $('#authorModal').modal('hide');
    });
  });
  
  $(document).ready(function() {
    $('#applyLocations').click(function() {
      // Pobieramy zaznaczone autorów z pól wyboru
      var selectedAuthors = $('input[name="location[]"]:checked').map(function(){
        return $(this).val();
      }).get();
      // Wykonujemy dowolne działania na podstawie wybranych autorów
      console.log(selectedAuthors);
      // Zamykamy modal
      $('#locationModal').modal('hide');
    });
  });

  $(document).ready(function() {
    $('#applyStyles').click(function() {
      // Pobieramy zaznaczone autorów z pól wyboru
      var selectedStyles = $('input[name="styles[]"]:checked').map(function(){
        return $(this).val();
      }).get();
      // Wykonujemy dowolne działania na podstawie wybranych autorów
      console.log(selectedAuthors);
      // Zamykamy modal
      $('#styleModal').modal('hide');
    });
  });

  function applyFilters() {
    var selectedAuthors = $('input.form-check-input:checked').map(function(){
        return $(this).val();
    }).get();
    generateGallery(); // przekazuje wybrane wartości do funkcji
}


  function generateGallery() {
    var selectedAuthors = $('input[name="author[]"]:checked').map(function(){
      return $(this).val();
    }).get();
    
    $.ajax({
      url: 'generate_gallery.php',
      type: 'POST',
      data: {
        authors: selectedAuthors
      },
      success: function(html) {
        $('#gallery').html(html);
      }
    });
  }
