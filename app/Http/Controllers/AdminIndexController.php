<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminIndexController extends Controller
{
    public function index(){
        return view('pages.admin.index');
    }
}
