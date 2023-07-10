<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

use function Ramsey\Uuid\v1;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();

        return view('books.index', [
            'title' => 'Rental Buku | Book',
            'books' => $books,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('books.create', [
            'title'         => 'Rental Buku | Create Book',
            'categories'    => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'book_code'     => 'required|max:13|unique:books',
            'title'         => 'required|max:60',
        ]);

        if ($request->file('images')) {
            $extension = $request->file('images')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->storeAs('cover', $newName);
        }

        $validateData['cover'] = $newName;

        $book = Book::create($validateData);
        $book->categories()->sync($request->categories);

        return redirect('/books')->with('success', 'Successfully add New Book');
    }

    public function edit($slug)
    {
        $books = Book::where('slug', $slug)->first();
        $categories = Category::all();

        return view('books.edit', [
            'title'      => 'Rental Buku | Edit Book',
            'books'      => $books,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'book_code'     => 'required|max:13',
            'title'         => 'required|max:60',
        ]);

        $newName = '';

        if ($request->file('images')) {
            $extension = $request->file('images')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->storeAs('cover', $newName);
        }

        $validateData['cover'] = $newName;
        $books = Book::where('id', $book->id)->first();
        $books->update($request->post());

        if ($request->categories) {
            $books->categories()->sync($request->categories);
        }

        return redirect('/books')->with('success', 'Update Book successfully');
    }

    public function destroy(Book $book)
    {
        Book::destroy($book->id);

        return redirect('/books')->with('success', 'Delete Book successfully');
    }
}
