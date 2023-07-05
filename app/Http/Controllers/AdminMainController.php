<?php

namespace App\Http\Controllers;

class AdminMainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
