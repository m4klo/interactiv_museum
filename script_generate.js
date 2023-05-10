$(document).ready(function() {
    $(".image-link").click(function(e) {
        e.preventDefault();
        const src = $(this).find("img").attr("src");
        const title = $(this).data("title");
        const author = $(this).data("author");
        const location_id = $(this).data("id_location");
        const session_location_id = $("#edit-button").data("session-location-id");
        console.log(session_location_id);
        console.log(location_id);
        $("#myModal-content").attr("src", src);
        $("#myModal-title").text(title);
        $("#myModal-author").text(author);
        if (location_id == session_location_id) {
            $("#edit-button").show(); // Pokaż przycisk "Edytuj"
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
    });

    // Funkcja obsługująca przycisk "Powrót"
    $("#backButton").click(function() {
        $("#myModal").fadeOut();
        $("#myModal-content").attr("src", "");
        $("#backButton").fadeOut();
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


