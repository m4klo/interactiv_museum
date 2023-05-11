$(document).ready(function() {
    $(".image-link").click(function(e) {
        e.preventDefault();
        const src = $(this).find("img").attr("src");
        const title = $(this).data("title");
        const author = $(this).data("author");
        const location_id = $(this).data("id_location");
        const session_location_id = $("#edit-button").data("session-location-id");
        const id = $(this).data("id");
        console.log(session_location_id);
        console.log(location_id);
        $("#myModal-content").attr("src", src);
        $("#myModal-title").text(title);
        $("#myModal-author").text(author);
        if (location_id == session_location_id) {
            $("#edit-button").show(); // Pokaż przycisk "Edytuj"
            $("#edit-button").data("id", id);
        }
        else{
            $("#edit-button").hide(); // Ukryj przycisk "Edytuj"
        }
        $("#myModal").fadeIn();
        $("#backButton").fadeIn();
    });

    // Funkcja obsługująca przycisk "Zamknij"
    $("#myModal-close").click(function() {
        $("#myModal").fadeOut();
        $("#backButton").fadeOut();
        if(dataChanged == true)
        {
            dataChanged = false;
            location.reload();
        }
    });

    // Funkcja obsługująca przycisk "Powrót"
    $("#backButton").click(function() {
        $("#myModal").fadeOut();
        $("#myModal-content").attr("src", "");
        $("#backButton").fadeOut();
        if(dataChanged == true)
        {
            dataChanged = false;
            location.reload();
        }
    });
});

$(document).ready(function() {
    $("#edit-button").click(function() {
        const titleElement = $("#myModal-title");
        const authorElement = $("#myModal-author");

        if ($(this).text() === "Zapisz") {
            // Pobierz zaktualizowane wartości tytułu i autora
            const updatedTitle = titleElement.text();
            const updatedAuthor = authorElement.text();
            const id = $(this).data("id");
            console.log(updatedAuthor);
            console.log(updatedTitle);
            console.log(id);
            // Wywołaj skrypt PHP do aktualizacji danych w bazie danych
            $.ajax({
                url: "update_data.php",
                method: "POST",
                data: {
                    id: id,
                    title: updatedTitle,
                    author: updatedAuthor
                },
                success: function(response) {
                    // Obsługa sukcesu (opcjonalnie)
                    console.log("Dane zostały zaktualizowane.");
                    dataChanged = true;
                },
                error: function(xhr, status, error) {
                    // Obsługa błędu (opcjonalnie)
                    console.error("Wystąpił błąd podczas aktualizacji danych: " + error);
                }
            });

            // Zmień tekst przycisku na "Edytuj"
            $(this).text("Edytuj");

            // Usuń atrybut "contenteditable" i klasę CSS "editable"
            titleElement.removeAttr("contenteditable");
            authorElement.removeAttr("contenteditable");
            titleElement.removeClass("editable");
            authorElement.removeClass("editable");
        } else {
            // Przypisanie atrybutu "contenteditable" dla możliwości edycji
            titleElement.attr("contenteditable", true);
            authorElement.attr("contenteditable", true);

            // Dodanie klasy CSS do wyróżnienia edycji
            titleElement.addClass("editable");
            authorElement.addClass("editable");

            // Zmiana tekstu przycisku na "Zapisz"
            $(this).text("Zapisz");
        }
    });
});

function prevPage() {
    if (pageNum > 1) {
        pageNum--;
        generateGallery(pageNum, totalPages);
    }
}

function nextPage() {
    if (pageNum < totalPages) {
        pageNum++;
        generateGallery(pageNum, totalPages);
    }
}


