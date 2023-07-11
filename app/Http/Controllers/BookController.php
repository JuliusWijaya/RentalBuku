<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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

        $newName = '';

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

    public function show()
    {
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
        $rules = [
            'book_code'     => 'required|max:13',
            'title'         => 'required|max:60',
            'images'        => 'image|mimes:jpg,png,jpeg',
        ];


        if ($request->file('images')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $extension = $request->file('images')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $validateData = $request->validate($rules);
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

    public function deleteBook()
    {
        $books = Book::onlyTrashed()->get();

        return view('books.delete', [
            'title'     => 'Rental Buku | List Delete',
            'books'     => $books,
        ]);
    }

    public function restoreBook($slug)
    {
        $books = Book::withTrashed()->where('slug', $slug)->first();
        $books->restore();

        return redirect('/books')->with('success', 'Restore Book successfully');
    }
}