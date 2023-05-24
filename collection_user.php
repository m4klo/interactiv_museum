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
                        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#styleModal">Filtruj styl</button>
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
        let checkedStyles=[];
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
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedStyles(checkedStyles), getCheckedLocations(checkedLocations))">Filtruj
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
                    <h5 class="modal-title" id="locationModalLabel">Wybierz autora</h5>
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
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedStyles(checkedStyles), getCheckedLocations(checkedLocations))">Filtruj
                    </button>
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
                <div class="modal-search">
                    <input type="text" id="searchInputStyle" class="form-control" placeholder="Wyszukaj autora" oninput="checkedStyles = getCheckedStyles(checkedStyles); 
                    generateStyles(this.value, checkedStyles);">
                </div>
                <div class="modal-body" id="styleList">
                <script>
                    $(document).ready(function() {
                        generateStyles('');
                    });
                </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-primary" id="styleFilterButton" 
                        onclick="generateGallery(pageNum=1, getCheckedAuthors(checkedAuthors), getCheckedStyles(checkedStyles), getCheckedLocations(checkedLocations))">Filtruj
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

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </button>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="login_username">Nazwa użytkownika:</label>
                <input type="text" class="form-control" id="login_username" name="login_username" required>
            </div>
            <div class="form-group">
                <label for="login_password">Hasło:</label>
                <input type="password" class="form-control" id="login_password" name="login_password" required>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            <button type="button" class="btn btn-primary" onclick="login()">Zaloguj się</button>
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
