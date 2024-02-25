<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function book()
    {
        return $this->belongsToMany(Categories::class, 'book_categories','books_id', 'categories_id');
    }
}
