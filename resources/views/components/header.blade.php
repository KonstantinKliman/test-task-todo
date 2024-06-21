<nav class="navbar navbar-expand-lg bg-body-secondary border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('show-main-page') }}">TODO`s</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show-main-page') }}">Home</a>
                </li>
            </ul>
            <div class="d-flex" id="authInfo">
                <a href="{{ route('show-login-page') }}" class="btn btn-outline-secondary me-2">Login</a>
                <a href="{{ route('show-register-page') }}" class="btn btn-outline-secondary">Register</a>
            </div>
            <div class="d-none align-items-center" id="userInfo">
                <p class="mb-0 me-2"></p>
                <button class="btn btn-sm btn-outline-danger" id="logoutBtn">Logout</button>
            </div>
        </div>
    </div>
</nav>
