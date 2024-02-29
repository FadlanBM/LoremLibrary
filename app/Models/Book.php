<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

     protected $fillable = ['title','author','publisher','description','code','year_published','img'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'book_categories','books_id', 'categories_id');
    }
}
