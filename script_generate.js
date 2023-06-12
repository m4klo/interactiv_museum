$(document).ready(function() {
    $(".image-link").click(function(e) {
        e.preventDefault();
        const src = $(this).find("img").attr("src");
        const title = $(this).data("title");
        const author = $(this).data("author");
        const location_id = $(this).data("id_location");
        const session_location_id = $("#edit-button").data("session-location-id");
        const id = $(this).data("id");
        const wiki_link = $(this).data("wiki_link");
        const wikiButton = $('<a>').attr('href', wiki_link).text('Przejdź do strony wiki');
        console.log(session_location_id);
        console.log(location_id);
        $("#myModal-content").attr("src", src);
        $("#myModal-title").text(title);
        $("#myModal-author").text(author);
        if (location_id == session_location_id || session_location_id == 'administrator') {
            $("#edit-button").show(); // Pokaż przycisk "Edytuj"
            $("#edit-button").data("id", id);
        }
        else{
            $("#edit-button").hide(); // Ukryj przycisk "Edytuj"
        }
        $("#myModal").fadeIn();
        $("#backButton").fadeIn();
        $("#myModal-wiki").empty().append(wikiButton);
    });

    // Funkcja obsługująca przycisk "Zamknij"
    $("#myModal-close").click(function() {
        $("#myModal").fadeOut();
        $("#backButton").fadeOut();
        if($("#edit-button").data("changed") == "true")
        {
            $("#edit-button").data("changed", "false");
            location.reload();
        }
        if ($("#edit-button").text() == "Zapisz") {
            $("#edit-button").text("Edytuj");
        }
    });

    // Funkcja obsługująca przycisk "Powrót"
    $("#backButton").click(function() {
        $("#myModal").fadeOut();
        $("#myModal-content").attr("src", "");
        $("#backButton").fadeOut();
        if($("#edit-button").data("changed") == "true")
        {
            $("#edit-button").data("changed", "false");
            location.reload();
        }
        if ($("#edit-button").text() == "Zapisz") {
            $("#edit-button").text("Edytuj");
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
                    $("#edit-button").data("changed", "true");
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
// Dodaj funkcję obsługującą animację przechodzenia między stronami
function prevPage() {
    if (pageNum > 1) {
        pageNum--;
        animateGalleryTransition('animate-from-left');
        animateButtonsTransition('animate-from-bottom');
        setTimeout(function() {
            generateGallery(pageNum, checkedAuthors, checkedStyles, checkedLocations);
        }, 2000);
    }
}

function nextPage(total) {
    if (pageNum < total) {
        pageNum++;
        animateGalleryTransition('animate-from-left');
        animateButtonsTransition('animate-from-bottom');
        setTimeout(function() {
            generateGallery(pageNum, checkedAuthors, checkedStyles, checkedLocations);
        }, 2000);
    }
}

function animateGalleryTransition(animationClass) {
    const galleryImages = document.querySelectorAll('.gallery-image');
    galleryImages.forEach(image => {
        image.classList.add(animationClass);
    });
}

function animateButtonsTransition(animationClass) {
    const pageButtons = document.querySelectorAll('.gallery-pagination');
    pageButtons.forEach(button => {
        button.classList.add(animationClass);
    });
}
