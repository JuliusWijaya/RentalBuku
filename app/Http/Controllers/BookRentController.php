<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class BookRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role_id', '!=', 1)
            ->where('status', 'active')->get();
        $book = Book::latest()->get();

        return view('book-rents.index', [
            'title'     => 'Rental Buku | Book Rent',
            'users'     => $user,
            'books'     => $book,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required',
            'book_id'   => 'required',
        ]);

        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(6)->toDateString();

        $bookStatus = Book::where('id', $request->book_id)->pluck('status');

        if ($bookStatus['0'] != 'in stock') {
            Session::flash('status', 'Cannot Rent The Book is no Availabel !');
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $count = RentLog::where('user_id', $request->user_id)
                ->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('status', 'Cannot rent user has rich limit of book !');
                Session::flash('alert-class', 'alert-danger');
                return back();
            }

            try {
                DB::beginTransaction();
                // Proses insert to rent_logs table
                RentLog::create($request->post());
                // Proses update status book table
                $book = Book::where('id', $request->book_id)->first();
                $book->status = 'not available';
                $book->save();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

        Session::flash('status', 'Rent book successfully');
        Session::flash('alert-class', 'alert-success');

        return redirect('/book-rents');
    }

    public function returnBook()
    {
        $user = User::where('role_id', '!=', 1)
            ->where('status', 'active')->get();
        $book = Book::latest()->get();

        return view('book-return.index', [
            'title'     => 'Rental Buku | Book Return',
            'users'     => $user,
            'books'     => $book,
        ]);
    }

    public function returnBookAction(Request $request)
    {
        $request->validate([
            'user_id'   => 'required',
            'book_id'   => 'required',
        ]);

        $rent = RentLog::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();

        // User dan buku yang dipilih untuk direturn benar, maka berhasil return book
        if ($countData == 1) {
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            $books = Book::where('id', $request->book_id)->first();
            $books->status = 'in stock';
            $books->save();

            Session::flash('status', 'Return book successfully');
            Session::flash('alert-class', 'alert-success');

            return redirect('/book-return');
        } else {
            // User dan buku yang dipilih untuk direturn salah, maka akan muncul notifikasi / alert
            Session::flash('status', 'Return book failed');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/book-return');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
