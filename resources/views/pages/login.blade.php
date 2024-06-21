@extends('layouts.main')

@section('main')
    <div class="h-100 d-flex justify-content-center align-items-center">
        <form class="w-25">
            <div class="d-flex flex-column border p-4 rounded bg-body-tertiary">
                <h4 class="text-center mb-2">Login</h4>
                <input type="email" name="email" class="form-control mb-2" placeholder="Enter your email">
                <input type="password" name="password" class="form-control mb-2" placeholder="Enter your password">
                <div
                    class="w-auto mb-2 border rounded d-none justify-content-start align-items-center p-2 border-danger bg-danger-subtle text-danger"
                    id="loginFormError">
                    Error
                </div>
                <button type="submit" class="btn btn-outline-secondary">Login</button>
            </div>
        </form>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/login.js') }}"></script>
@endsection
