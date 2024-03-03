<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lendings extends Model
{
    use HasFactory;

    protected $table = 'lendings';

    public function listlending()
    {
        return $this->belongsToMany(Book::class, 'list_lendings', 'lending_id', 'books_id')->withPivot('no_inventaris');
    }

     public function borrower()
    {
        return $this->belongsTo(Borrowers::class, 'borrowers_id', 'id');
    }
}
