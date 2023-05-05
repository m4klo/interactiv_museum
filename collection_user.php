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

$query = "SELECT id, name FROM style";
$result = mysqli_query($conn, $query);

$styles = array();
while ($row = mysqli_fetch_assoc($result)) {
    $style_id=$row['id'];
    $style_name=$row['name'];
    $styles[] = array('id' => $style_id, 'name' => $style_name);
}

$query = "SELECT id, name FROM location";
$result = mysqli_query($conn, $query);

$locations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $location_id=$row['id'];
    $location_name=$row['name'];
    $locations[] = array('id' => $location_id, 'name' => $location_name);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Zbiory muzeów narodowych</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
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
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Zarejestruj</button>
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
                    <script>
                        let totalPages=2;
                        let pageNum = 1;
                    </script>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="filterButton" onclick="generateGallery(pageNum)">Filtruj</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Location filter-->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Wybierz autora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    foreach ($locations as $location) {
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="checkbox" value="' . $location['id'] . '" id="' . $location['id'] . '">';
                        echo '<label class="form-check-label" for="' . $location['id'] . '">';
                        echo $location['name'];
                        echo '</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="filterButton" onclick="generateGallery(pageNum)">Filtruj</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Style filter-->
    <div class="modal fade" id="styleModal" tabindex="-1" aria-labelledby="styleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="styleModalLabel">Wybierz autora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    foreach ($styles as $style) {
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="checkbox" value="' . $style['id'] . '" id="' . $author['id'] . '">';
                        echo '<label class="form-check-label" for="' . $style['id'] . '">';
                        echo $style['name'];
                        echo '</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="filterButton" onclick="generateGallery(1)">Filtruj</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function register(){
        // Pobranie danych z formularza
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var location = $('#location').val();

        console.log(username);
        console.log(email);
        console.log(password);
        console.log(location);

        $.ajax({
            url: "register.php",
            type: "POST",
            data: {
                username: username,
                email: email,
                password: password,
                location: location
            },
            success: function(data) {
                console.log('Pomyślnie zarejestrowano użytkownika');
            },
            error: function(xhr, status, error) {
                console.log('Wystąpił błąd podczas rejestracji użytkownika');
            }
        })
    }
    </script>

    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Rejestracja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </button>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Adres e-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
            <label for="location">Lokalizacja:</label>
            <select class="form-control selectpicker" id="location" name="location" data-live-search="true" required>
                <option value="" disabled selected>Wybierz lokalizację...</option>
                <?php foreach ($locations as $location) { ?>
                <option value="<?php echo $location['id']; ?>"><?php echo $location['name']; ?></option>
                <?php } ?>
            </select>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="register()">Zarejestruj się</button>
        </div>
        </div>
    </div>
    </div>

    
    <div class="container mt-5">
    <div id="gallery" class="row mb-10">
        <script>
        $(document).ready(function() {
            let totalPages=2;
            let pageNum = 1;
            generateGallery(pageNum, totalPages);
        });
        </script>
    </div>
    <button class="page-btn" data-page="1">1</button>
    <button class="page-btn" data-page="2">2</button>
    <button class="page-btn" data-page="3">3</button>
</div>


</body>
</html>
