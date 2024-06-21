<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function showMainPage(): View
    {
        return ViewFacade::make('pages.index');
    }

    public function showRegisterPage(): View
    {
        return ViewFacade::make('pages.register');
    }

    public function showLoginPage(): View
    {
        return ViewFacade::make('pages.login');
    }
}
