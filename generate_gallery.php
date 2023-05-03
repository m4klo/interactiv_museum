<?php
// database connection
require_once 'connect.php';

if (isset($_POST['selectedAuthors'])) {
    $selectedAuthors = $_POST['selectedAuthors'];
}
if (isset($_POST['selectedStyles'])) {
    $selectedStyles = $_POST['selectedStyles'];
}
if (isset($_POST['selectedLocations'])) {
    $selectedLocations = $_POST['selectedLocations'];
}

// Retrieve photo paths
$query = "SELECT p.title, p.picture_link, a.name AS author_name, s.name AS style_name, l.name AS location_name
FROM painting p
JOIN author a ON p.id_author = a.id
JOIN style s ON p.id_style = s.id
JOIN location l ON p.id_location = l.id";

$whereClause = array();

if (!empty($selectedAuthors)) {
    $whereClause[] = 'a.id IN (' . implode(',', $selectedAuthors) . ')';
}

if (!empty($selectedStyles)) {
    $whereClause[] = 's.id IN (' . implode(',', $selectedStyles) . ')';
}

if (!empty($selectedLocations)) {
    $whereClause[] = 'l.id IN (' . implode(',', $selectedLocations) . ')';
}

if (!empty($whereClause)) {
    $query .= ' WHERE ' . implode(' OR ', $whereClause);
}


$result = mysqli_query($conn, $query);

// Store the photo paths in an array
$photos = array();
while ($row = mysqli_fetch_assoc($result)) {
    $title= $row['title'];
    $author = $row['author_name'];
    $picture = $row['picture_link'];
    $photos[] = array('title' => $title, 'picture_link' => $picture, 'author_name' => $author);
}

?>

<?php
    // generuj kod HTML z obrazkami
    shuffle($photos); // losowo mieszamy tablicę zdjęć
    $photoIndex = 0;
    for ($i = 0; $i < 6; $i++) {
        echo '<div class="col-md-' . 2 . '">';
        for ($j = 0; $j < 2; $j++) {
            if ($photoIndex >= count($photos)) break;
            $photo = $photos[$photoIndex];
            echo '<div class="mb-4">';
            echo '<a href="' . $photo['picture_link'] . '" class="image-link" data-title="' . $photo['title'] . '" data-author="' . $photo['author_name'] . '">';
            echo '<img src="' . $photo['picture_link'] . '" class="img-thumbnail" alt="' . $photo['title'] . '">';
            echo '</a>';
            echo '</div>';
        $photoIndex++;
            }
        echo '</div>';
    }
?>

<!-- The Modal -->
<div id="myModal">
    <span id="myModal-close">&times;</span>
    <img id="myModal-content" />
    <h4 id="myModal-title"></h4>
    <h5 id="myModal-author"></h5>   
</div>

<script>
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
</script>
