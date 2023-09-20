<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show(){
        
        return view('index');
    }
}
