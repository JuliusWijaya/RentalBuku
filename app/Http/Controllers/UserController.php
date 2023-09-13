<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\RentLog;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();

        return view('users.index', [
            'title'  => 'Rental Buku | User',
            'users'  => $users,
        ]);
    }

    public function active()
    {
        $usersInActive = User::where('status', 'inactive')->get();

        return view('users.inactive', [
            'title'     => 'Rental Buku | User inActive',
            'inactive'  => $usersInActive
        ]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlog = RentLog::with(['user', 'book'])->where('user_id', $user->id)->paginate(5);

        return view('users.detail', [
            'title'     => 'Rental Buku | ' . $user->username,
            'user'      => $user,
            'rentlogs'  => $rentlog,
        ]);
    }

    public function update($slug)
    {
        $approveUser = User::where('slug', $slug)->first();
        $approveUser->status = 'active';
        $approveUser->save();

        return redirect('/users')->with('success', $approveUser->username . ' Successfully approved');
    }

    public function profile()
    {
        $rentlog = RentLog::with(['user', 'book'])->where('user_id', auth()->user()->id)->paginate(5);

        return view('profiles.index', [
            'title'     => 'Rental Buku | User Profile',
            'rentlogs'  => $rentlog,
        ]);
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'inactive';
        $user->save();
        $user->delete();

        return redirect('/users')->with('success', 'User has been banned');
    }

    public function deleteUser()
    {
        $user = User::onlyTrashed()->get();

        return view('users.delete', [
            'title'  => 'Rental Buku | List Ban User',
            'users'  => $user,
        ]);
    }

    public function restore($slug)
    {
        User::withTrashed()->where('slug', $slug)->restore();

        return redirect('/users')->with('success', 'User successfully Restore!');
    }
}