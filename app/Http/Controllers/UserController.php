<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        return view('users.detail', [
            'title'     => 'Rental Buku | ' . $user->username,
            'user'      => $user,
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

        return view('profiles.index', [
            'title' => 'Rental Buku | User Profile',
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
