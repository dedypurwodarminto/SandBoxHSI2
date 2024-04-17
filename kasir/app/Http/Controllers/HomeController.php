<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $pages = array(
            'title' => 'Warung Kita'
        );

        // return view('index', $pages);
        return view('home', $pages);
    }
}
