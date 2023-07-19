<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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

    public function listBook(Request $request)
    {
        $listCategory = Category::all();

        if ($request->category || $request->title) {
            $listBooks = Book::where('title', 'like', '%' . $request->title . '%')
                ->orWhereHas(
                    'categories',
                    fn ($query) =>
                    $query->where('categories.id', $request->category)
                )->get();
        } else {
            $listBooks = Book::latest()->paginate(8);
        }

        return view('pages.list-book', [
            'title'        => 'Rental Buku | List Book',
            'books'        => $listBooks,
            'category'     => $listCategory,
        ]);
    }
}
