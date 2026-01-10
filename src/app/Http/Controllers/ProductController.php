<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showIndex(){
        return view('index');
    }

    public function showStore(){
        return view('store');
    }
}
