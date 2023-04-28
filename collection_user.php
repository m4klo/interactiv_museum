<?php
// database connection
require_once 'connect.php';

$query = "SELECT id, name FROM author";
$result = mysqli_query($conn, $query);

$authors = array();
while ($row = mysqli_fetch_assoc($result)) {
    $author_id=$row['id'];
    $author_name=$row['name'];
    $authors[] = array('id' => $author_id, 'name' => $author_name);
}

$query = "SELECT name FROM style";
$result = mysqli_query($conn, $query);

$styles = array();
while ($row = mysqli_fetch_assoc($result)) {
    $styles[] = $row['name'];
}

$query = "SELECT name FROM location";
$result = mysqli_query($conn, $query);

$locations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = $row['name'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Zbiory muzeów narodowych</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

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



</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Wirtualny katalog zbiorów dzieł sztuki</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Zbiory muzeów narodowych</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#authorModal">Filtruj autora</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#styleModal">Filtruj styl</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#locationModal">Filtruj lokalizację</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal for Author filter-->
    <div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="authorModalLabel">Wybierz autora</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php
            foreach ($authors as $author) {
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" value="' . $author['id'] . '" id="' . $author['id'] . '">';
                echo '<label class="form-check-label" for="' . $author['id'] . '">';
                echo $author['name'];
                echo '</label>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="applyFilters()">Filtruj</button>
        </div>
        </div>
    </div>
</div>

</div>

    </div>
    </div>
    <!-- Modal for Location filter-->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="locationModalLabel">Wybierz lokalizację</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php
            foreach ($locations as $location) {
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" value="' . $location . '" id="' . $location . '">';
                echo '<label class="form-check-label" for="' . $location . '">';
                echo $location;
                echo '</label>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="applyFilters()">Filtruj</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal for Style filter-->
    <div class="modal fade" id="styleModal" tabindex="-1" aria-labelledby="styleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="styleModalLabel">Wybierz styl</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php
            foreach ($styles as $style) {
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" value="' . $author . '" id="' . $author . '">';
                echo '<label class="form-check-label" for="' . $author . '">';
                echo $style;
                echo '</label>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="applyFilters()">Filtruj</button>
        </div>
        </div>
    </div>
    </div>
    <div class="container mt-5">    
    <div id="gallery" class="row mb-10">
        <script>
        $(document).ready(function() {
            applyFilters();
        });
        </script>
    </div>
</div>


</body>
</html>
