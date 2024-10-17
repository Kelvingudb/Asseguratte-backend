$(document).ready(function() {
    $('#LoginForm').on('submit', function(event) {
        event.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'Models/Login.php',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                if (response.trim() === 'Inicio de sesión exitoso') {
                    window.location.href = 'views/dashboard.php';
                } else {
                    showToast(response);
                }
            },
            error: function() {
                showToast('Error en la solicitud. Por favor, intenta nuevamente.');
            }
        });
    });
});

function showToast(message) {
    $('.toast-body').text(message);


    var toastElement = new bootstrap.Toast($('.toast')); 
    toastElement.show();
}
