<?php
session_start();

if ($_SESSION['location_id'] !== 'administrator') {
    // Przekieruj użytkownika na inną stronę lub wyświetl komunikat o braku dostępu
    header('Location: collection_user.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zbiory muzeów narodowych</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT&display=swap" rel="stylesheet">
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
                        <a class="nav-link" href="collection_administrator.php">Zbiory muzeów narodowych</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="verification.php">Weryfikacja</a>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row">
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#authorModal">Filtruj autora</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#centuryModal">Filtruj wiek</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#locationModal">Filtruj lokalizację</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">Wyloguj</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        let pageNum = 1;
        let checkedAuthors=[];
        let checkedLocations=[];
        let checkedCenturies=[];
        let width = $(window).width();
        let widthNum = 0;
    </script>

    <!-- Modal for Author filter-->
    <div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorModalLabel">Wybierz autora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-search">
                    <input type="text" id="searchInputAuthor" class="form-control" placeholder="Wyszukaj autora" oninput="checkedAuthors = getCheckedAuthors(checkedAuthors); 
                    generateAuthors(this.value, checkedAuthors);">
                </div>
                <div class="modal-body" id="authorList">
                <script>
                    $(document).ready(function() {
                        generateAuthors('');
                    });
                </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="authorFilterButton" 
                    onclick="if (width <= 1200 && width > 1024) {
                            generateMobileGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else if(width <= 1024){
                            generatePhoneGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else {
                            generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        };">Filtruj</button>                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Location filter-->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Wybierz lokalizacje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-search">
                    <input type="text" id="searchInputLocation" class="form-control" placeholder="Wyszukaj lokalizacje" oninput="checkedLocations = getCheckedLocations(checkedLocations); 
                    generateLocations(this.value, checkedLocations);">
                </div>
                <div class="modal-body" id="locationList">
                <script>
                    $(document).ready(function() {
                        generateLocations('');
                    });
                </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="locationFilterButton" 
                    onclick="if (width <= 1200 && width > 1024) {
                            generateMobileGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else if(width <= 1024){
                            generatePhoneGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else {
                            generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }">Filtruj</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Century filter-->
    <div class="modal fade" id="centuryModal" tabindex="-1" aria-labelledby="centuryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centuryModalLabel">Wybierz wiek powstania</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-search">
                    <input type="text" id="searchInputcentury" class="form-control" placeholder="Wyszukaj wiek" oninput="checkedCenturies = getCheckedCenturies(checkedCenturies); 
                    generateCenturies(this.value, checkedCenturies);">
                </div>
                <div class="modal-body" id="centuryList">
                <script>
                    $(document).ready(function() {
                        generateCenturies('');
                    });
                </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="centuryFilterButton" 
                    onclick="if (width <= 1200 && width > 1024) {
                            generateMobileGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else if(width <= 1024){
                            generatePhoneGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }
                        else {
                            generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
                        }">Filtruj</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Potwierdzenie wylogowania</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Czy na pewno chcesz się wylogować?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
            <a href="logout.php" class="btn btn-primary">Wyloguj</a>
        </div>
        </div>
    </div>
    </div>
    
    <div class="container mt-5">
    <div id="gallery" class="row mb-10 gallery-container">
        <script>
        $(document).ready(function() {
            if (width <= 1200 && width > 1024) {
                generateMobileGallery(pageNum, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else if(width <= 1024){
                generatePhoneGallery(pageNum, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
            else {
                generateGallery(pageNum, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations));
            }
        });
        </script>
    </div>
</div>
<footer class="footer">
        <p>&copy; Wszystkie prawa zastrzeżone. Wykorzystanie zdjęć w celach edukacyjnych.</p>
</footer>
</body>
</html>
