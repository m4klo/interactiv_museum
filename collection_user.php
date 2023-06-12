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
    <script src="script_register_login.js"></script>
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
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#centuryModal">Filtruj wiek</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#locationModal">Filtruj lokalizację</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Zarejestruj</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Zaloguj się</button>
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
    </script>

    <!-- Modal for Author filter-->
    <div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations))">Filtruj
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Location filter-->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Wybierz lokalizacje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-search">
                    <input type="text" id="searchInputLocation" class="form-control" placeholder="Wyszukaj autora" oninput="checkedLocations = getCheckedLocations(checkedLocations); 
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
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations))">Filtruj
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Century filter-->
    <div class="modal fade" id="centuryModal" tabindex="-1" aria-labelledby="centuryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centuryModalLabel">Wybierz wiek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-search">
                    <input type="text" id="searchInputcentury" class="form-control" placeholder="Wyszukaj autora" oninput="checkedCenturies = getCheckedCenturies(checkedCenturies); 
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
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedCenturies(checkedCenturies), getCheckedLocations(checkedLocations))">Filtruj
                    </button>
                </div>
            </div>
        </div>
    </div>


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
                <label for="register_username">Nazwa użytkownika:</label>
                <input type="text" class="form-control" id="register_username" name="register_username" required>
            </div>
            <div class="form-group">
                <label for="register_name">Imie:</label>
                <input type="text" class="form-control" id="register_name" name="register_=name" required>
            </div>
            <div class="form-group">
                <label for="register_username">Nazwisko:</label>
                <input type="text" class="form-control" id="register_surname" name="register_surname" required>
            </div>
            <div class="form-group">
                <label for="register_email">Adres e-mail:</label>
                <input type="email" class="form-control" id="register_email" name="register_email" required>
            </div>
            <div class="form-group">
                <label for="register_password">Hasło:</label>
                <input type="password" class="form-control" id="register_password" name="register_password" required>
            </div>
            <div class="form-group">
            <label for="location">Lokalizacja:</label>
            <select class="form-control selectpicker" id="register_location" name="register_location" data-live-search="true" required>
                <script>
                    getLocations();
                </script>
            </select>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="register()" data-bs-dismiss="modal">Zarejestruj się</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Login Form -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Logowanie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nazwa użytkownika</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Hasło</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="adminCheckbox" name="adminCheckbox">
                            <label class="form-check-label" for="adminCheckbox">Administrator</label>
                        </div>
                        <input type="button" class="btn btn-primary" value="Zaloguj" onclick="login()">
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container mt-5">
    <div id="gallery" class="row mb-10">
        <script>
        $(document).ready(function() {
            generateGallery(pageNum);
        });
        </script>
    </div>
</div>


</body>
</html>
