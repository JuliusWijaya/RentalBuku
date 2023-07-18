<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books      = Book::count();
        $categories = Category::count();
        $users      = User::count();
        $rentlogs   = RentLog::with(['user', 'book'])->paginate(5);

        return view('dashboards.index', [
            'title'      => 'Rental Buku | Dashboard',
            'books'      => $books,
            'categories' => $categories,
            'users'      => $users,
            'rentlogs'   => $rentlogs,
        ]);
    }
}
