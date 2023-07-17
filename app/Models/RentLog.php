<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLog extends Model
{
    use HasFactory;

    protected $table = 'rent_logs';
    protected $fillable = ['user_id', 'book_id', 'rent_date', 'return_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}