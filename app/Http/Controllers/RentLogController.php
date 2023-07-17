<?php

namespace App\Http\Controllers;

use App\Models\RentLog;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        $rentLogs = RentLog::with(['user', 'book'])->get();

        return view('rent-logs.index', [
            'title'     => 'Rental Buku | Rent Log',
            'rentlogs'  => $rentLogs,
        ]);
    }
}