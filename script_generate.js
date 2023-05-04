let totalPages=2;
let pageNum=1;
$(document).ready(function() {
    $(".image-link").click(function(e) {
        e.preventDefault();
        var src = $(this).find("img").attr("src");
        var title = $(this).data("title");
        var author = $(this).data("author");
        $("#myModal-content").attr("src", src);
        $("#myModal-title").text(title);
        $("#myModal-author").text(author);
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


