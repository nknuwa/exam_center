<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index() {
        return view('pages.center.index');
    }
}
