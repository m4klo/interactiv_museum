function verifyCurator(curatorId) {
    $.ajax({
      url: 'verify_curator.php',
      type: 'POST',
      data: { curatorId: curatorId },
      success: function(response) {
        // Przetwarzaj odpowiedź serwera po pomyślnym zaktualizowaniu statusu
        console.log('Kurator został zaakceptowany.');
        getVerificationTable();
      },
      error: function(xhr, status, error) {
        // Obsłuż błąd AJAX
        console.log('Wystąpił błąd podczas akceptowania kuratora:', error);
      }
    });
  }
  
  function rejectCurator(curatorId) {
    $.ajax({
      url: 'reject_curator.php',
      type: 'POST',
      data: { curatorId: curatorId },
      success: function(response) {
        // Przetwarzaj odpowiedź serwera po pomyślnym odrzuceniu
        console.log('Kurator został odrzucony.');
        getVerificationTable();
      },
      error: function(xhr, status, error) {
        // Obsłuż błąd AJAX
        console.log('Wystąpił błąd podczas odrzucania kuratora:', error);
      }
    });
  }