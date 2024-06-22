// const APP_URL = process.env.API_URL || '';

$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault();

        var name = $('input[name="name"]').val();
        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        var passwordConfirmation = $('input[name="passwordConfirmation"]').val();

        $('input').removeClass('is-invalid');

        $.ajax({
            url: '/api/auth/register',
            method: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
                passwordConfirmation: passwordConfirmation
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
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
                    success: function (response) {
                        localStorage.setItem('token', response.token);
                        window.location.href = '/';
                    },
                    error: function (error) {
                    }
                })
            },
            error: function(response) {
                var errorField = $('#registerFormError');
                var errors = response.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    $('input[name="'+ key +'"]').addClass('is-invalid');
                    errorMessage += value[0] + '\n';
                });
                errorField.removeClass('d-none').addClass('d-flex').text(errorMessage);
            }
        });
    });
});
