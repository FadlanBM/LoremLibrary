<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EmployeesIndexController extends Controller
{
    public function index(){
        return view('pages.employees.index');
    }
}
