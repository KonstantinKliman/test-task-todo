$(document).ready(function () {
    $('form').on('submit', function (event) {
        event.preventDefault();

        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        var errorField = $('#loginFormError');

        $('input').removeClass('is-invalid');

        $.ajax({
            url: '/api/auth/login',
            method: 'POST',
            data: {
                email: email,
                password: password
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (loginResponse) {
                localStorage.setItem('token', loginResponse.token);
                window.location.href = '/';
            },
            error: function (loginError) {
                var errors = loginError.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    $('input[name="'+ key +'"]').addClass('is-invalid');
                    errorMessage += value[0] + '\n';
                });
                errorField.removeClass('d-none').addClass('d-flex').text(errorMessage);
            }
        });
    })
});
