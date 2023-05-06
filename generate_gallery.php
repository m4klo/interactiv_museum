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
if (isset($_POST['pageNum'])) {
    $pageNum = $_POST['pageNum'];
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

// Zdefiniuj liczbę wyników na stronę
$resultsPerPage = 12;

// Oblicz indeks pierwszego wyniku na stronie
$offset = ($pageNum - 1) * $resultsPerPage;

// Oblicz liczbę wyników ogółem
$totalResults = mysqli_num_rows(mysqli_query($conn, $query));

// Oblicz liczbę stron na podstawie liczby wyników ogółem i liczby wyników na stronę
$totalPages = ceil($totalResults / $resultsPerPage);

// Zmodyfikuj zapytanie SQL, aby uwzględniało limit wyników i przesunięcie
$query .= " LIMIT $resultsPerPage OFFSET $offset";

// Wykonaj zapytanie do bazy danych i pobierz wyniki
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
<script src="script_generate.js"></script> 

<!-- The Modal -->
<div id="myModal">
    <span id="myModal-close">&times;</span>
    <img id="myModal-content" />
    <h4 id="myModal-title"></h4>
    <h5 id="myModal-author"></h5>   
</div>

<div class="gallery-pagination">
        <button class="prev-btn" onclick="prevPage()">Previous</button>
        <button class="next-btn" onclick="nextPage()">Next</button>
</div>