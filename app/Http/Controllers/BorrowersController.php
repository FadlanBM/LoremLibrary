<?php

namespace App\Http\Controllers;

use App\Models\Borrowers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BorrowersController extends Controller
{
    public function index(){
        $borrowers=Borrowers::all();
        return view('pages.employees.BorrowersManagement', ['borrowers'=>$borrowers]);
    }
}
