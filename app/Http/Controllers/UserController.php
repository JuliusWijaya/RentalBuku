<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('profiles.index', ['title' => 'Rental Buku | Profile']);
    }
}
