<?php
session_start();
// database connection
require_once 'connect.php';

$selectedAuthors = [];
$selectedcenturies = [];
$selectedLocations = [];
$pageNum = 1;

if (isset($_POST['selectedAuthors'])) {
    $selectedAuthors = $_POST['selectedAuthors'];
}

if (isset($_POST['selectedcenturies'])) {
    $selectedcenturies = $_POST['selectedcenturies'];
}

if (isset($_POST['selectedLocations'])) {
    $selectedLocations = $_POST['selectedLocations'];
}

if (isset($_POST['pageNum'])) {
    $pageNum = $_POST['pageNum'];
}

// Tworzenie zapytania SQL
$query = "SELECT p.id, p.title, p.picture_link, p.id_location, p.wiki_link, a.name AS author_name, s.age AS century_age, l.name AS location_name
FROM painting p
JOIN author a ON p.id_author = a.id
JOIN century s ON p.id_century = s.id
JOIN location l ON p.id_location = l.id";

$whereClause = array();

if (!empty($selectedAuthors)) {
    $whereClause[] = 'p.id_author IN (' . implode(',', $selectedAuthors) . ')';
}

if (!empty($selectedcenturies)) {
    $whereClause[] = 'p.id_century IN (' . implode(',', $selectedcenturies) . ')';
}

if (!empty($selectedLocations)) {
    $whereClause[] = 'p.id_location IN (' . implode(',', $selectedLocations) . ')';
}

if (!empty($whereClause)) {
    $query .= ' WHERE ' . implode(' AND ', $whereClause);
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
    $id= $row['id'];
    $title= $row['title'];
    $author = $row['author_name'];
    $picture = $row['picture_link'];
    $id_loc = $row['id_location'];
    $wiki_link = $row['wiki_link'];
    $photos[] = array('id' => $id, 'title' => $title, 'picture_link' => $picture, 'author_name' => $author, 'wiki_link' => $wiki_link, 'id_location' => $id_loc);
}
?>

<div class="container mt-5">
    <div id="gallery" class="row mb-10">
        <?php
        // generuj kod HTML z obrazkami
        shuffle($photos); // losowo mieszamy tablicę zdjęć
        $photoIndex = 0;
        for ($i = 0; $i < 2; $i++) { // Zmieniono warunek z $i < 3 na $i < 2
        echo '<div class="col-md-6 col-sm-6 col-12">'; // Zmieniono col-md-4 na col-md-6
        for ($j = 0; $j < 6; $j++) {
            if ($photoIndex >= count($photos)) break;
            $photo = $photos[$photoIndex];
            echo '<div class="mb-20 gallery-image" data-page="' . ($pageNum + 1) . '">';
            echo '<a href="' . $photo['picture_link'] . '" class="image-link" data-title="' . $photo['title'] . '" data-author="' . $photo['author_name'] . '" data-id_location="' . $photo['id_location'] .  '" data-id="' . $photo['id'] .'" data-wiki_link="' . $photo['wiki_link'] .'">';
            echo '<img src="' . $photo['picture_link'] . '" class="img-fluid img-thumbnail" alt="' . $photo['title'] . '">';
            echo '</a>';
            echo '</div>';
            $photoIndex++;
        }
        echo '</div>';
        }
        ?>
    </div>
</div>


<script src="script_generate.js"></script> 
<link rel="stylesheet" href="style_button.css">

<!-- The Modal -->
<div id="myModal">
    <span id="myModal-close">&times;</span>
    <img id="myModal-content" />
    <h4 id="myModal-title"></h4>
    <h5 id="myModal-author"></h5>
    <h6 id="myModal-wiki"></h6>
    <button id="edit-button" data-session-location-id="<?php echo $_SESSION['location_id']; ?>" data-id="<?php echo $id; ?>" data-changed="false">Edytuj</button>
</div>

<div class="gallery-pagination animate-bottom">
    <div class="page-buttons-container">
        <button class="prev-btn" onclick="prevPage()">Poprzednia</button>
        <button class="next-btn" onclick="nextPage(<?php echo $totalPages; ?>)">Następna</button>
    </div>
    <span id="pageButtonsContainer"></span>
</div>

<script>
    // Sprawdź, czy zmienna "total" już istnieje
    if (typeof total === 'undefined' || total === null) {
        let total = <?php echo $totalPages; ?>;
        console.log(total);
        generatePageButtons(total, <?php echo $pageNum; ?>);
    }
</script>
