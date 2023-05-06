function register(){
    // Pobranie danych z formularza
    const username = $('#username').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const location = $('#location').val();

    console.log(username);


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
    const username = $('#username').val();
    const password = $('#password').val();

    console.log(username);
    console.log(password);

    $.ajax({
        type: "POST",
        url: "login.php",
        data: {username: username, password: password},
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