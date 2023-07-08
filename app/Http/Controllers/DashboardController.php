<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books      = Book::count();
        $categories = Category::count();
        $users      = User::count();

        return view('dashboards.index', [
            'title'      => 'Rental Buku | Dashboard',
            'books'      => $books,
            'categories' => $categories,
            'users'      => $users,
        ]);
    }
}