function register(){
    // Pobranie danych z formularza
    const username = $('#register_username').val();
    const name = $('#register_name').val();
    const surname = $('#register_surname').val();
    const email = $('#register_email').val();
    const password = $('#register_password').val();
    const location = $('#register_location').val();

    $.ajax({
        url: "register.php",
        type: "POST",
        data: {
            username: username,
            name: name,
            surname: surname,
            email: email,
            password: password,
            location: location
        },
        success: function(data) {
            console.log('Pomyślnie zarejestrowano użytkownika');
            alert("Użytkownik został dodany do weryfikacji");
        },
        error: function(xhr, status, error) {
            console.log('Wystąpił błąd podczas rejestracji użytkownika');
        }
    });
}

$(document).ready(function() {
    // Obsługa zdarzenia submit dla formularza logowania wewnątrz modala
    $('#login_form').submit(function(event) {
        event.preventDefault(); // Zatrzymanie domyślnego działania przeglądarki
        login(); // Wywołanie funkcji logowania
    });
});

function login() {
    const username = $('#username').val();
    const password = $('#password').val();
    const isAdmin = $('#adminCheckbox').is(':checked');

    console.log(isAdmin);

    $.ajax({
        
        type: "POST",
        url: "login.php",
        data: {
            username: username,
            password: password,
            isAdmin: isAdmin
        },
        dataType: 'json', // Określenie typu danych jako JSON
        success: function (data) {
            if (data.status === 'success') {
                window.location.href = data.redirect;
            } else if (data.status === 'success_admin') {
                window.location.href = data.redirect;
            } else {
                alert("Błąd logowania. Spróbuj ponownie.");
            }
        },
        error: function (xhr, status, error) {
            console.log("Wystąpił błąd: " + error);
        }
    });
}