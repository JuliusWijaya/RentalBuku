<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = ['book_code', 'title', 'slug', 'cover'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'category_id');
    }
}