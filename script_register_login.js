function register(){
    // Pobranie danych z formularza
    const username = $('#register_username').val();
    const email = $('#register_email').val();
    const password = $('#register_password').val();
    const location = $('#register_location').val();

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
    });
}

function login(){
    const username = $('#login_username').val();
    const password = $('#login_password').val();

    $.ajax({
        type: "POST",
        url: "login.php",
        data: {
            username: username, 
            password: password
        },
        success: function(data) {
        if (data == 'success') {
            window.location.href = "collection_curator.php";
        } else {
            alert("Błąd logowania. Spróbuj ponownie.");
        }
        },
        error: function(xhr, status, error) {
        console.log("Wystąpił błąd: " + error);
        }
    });
}