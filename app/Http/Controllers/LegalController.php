<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function terms(Request $request): View
    {
        return $this->themeService->view('legal.terms');
    }

    public function privacy(Request $request): View
    {
        return $this->themeService->view('legal.privacy');
    }
}
