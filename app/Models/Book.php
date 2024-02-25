<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

     protected $fillable = ['title','author','no_inventaris','publisher','description','code','year_published','img'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'book_category','book_id', 'category_id');
    }
}
