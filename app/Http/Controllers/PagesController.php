<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'title'     => 'Rental Buku',
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title'     => 'Rental Buku | About',
        ]);
    }

    public function listBook()
    {
        $listBooks = Book::all();

        return view('pages.list-book', [
            'title'     => 'Rental Buku | List Book',
            'books'     => $listBooks,
        ]);
    }
}
