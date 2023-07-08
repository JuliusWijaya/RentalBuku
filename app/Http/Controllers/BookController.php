<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', ['title' => 'Rental Buku | Book']);
    }
}