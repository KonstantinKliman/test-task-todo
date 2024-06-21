$(document).ready(function() {
    function getToken() {
        return localStorage.getItem('token');
    }

    var userInfo = $('#userInfo');
    var authInfo = $('#authInfo');
    var guestContent = $('#guestContent');
    var userContent = $('#userContent');
    var scripts = $('#todoScript');

    function showUserInfo(response) {
        authInfo.removeClass('d-flex').addClass('d-none');
        userInfo.removeClass('d-none').addClass('d-flex');
        userInfo.children('p').text(response.name);
        guestContent.addClass('d-none').removeClass('d-flex');
        userContent.addClass('d-block').removeClass('d-none');
        scripts.append($("<script>", {
            src: "/assets/js/todo.js"
        }))
    }

    function showGuestInfo() {
        userInfo.removeClass('d-flex').addClass('d-none');
        authInfo.removeClass('d-none').addClass('d-flex');
        guestContent.removeClass('d-none').addClass('d-flex');
        guestContent.append($('<h1>', {
            text: "Welcome to TODOs, guest!"
        }));
        userContent.addClass('d-none').removeClass('d-block');
    }

    function checkAuth() {
        var token = getToken();

        if (!token) {
            showGuestInfo();
            return;
        }

        $.ajax({
            url: '/api/auth/user',
            method: 'GET',
            headers: {
                'authorization': 'Bearer ' + token
            },
            success: function(response) {
                showUserInfo(response);
            },
            error: function(error) {
                if (error.status === 401) {
                    showGuestInfo();
                    console.warn('User is not authorized');
                } else {
                    console.error('An error occurred:', error);
                }
            }
        });
    }

    var logout = function() {
        $.ajax({
            url: '/api/auth/logout',
            method: 'POST',
            headers: {
                'authorization': 'Bearer ' + getToken()
            },
            success: function(response) {
                localStorage.removeItem('token');
                showGuestInfo();
            },
            error: function(error) {
                console.error(error);
            }
        });
    };

    checkAuth();

    $('#logoutBtn').on('click', logout);
});
