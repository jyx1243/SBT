<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;

class IndexController extends Controller
{
    public function index()
    {
        $options = Option::orderBy('used_at', 'desc')->take(6)->get();
        return view('index', ['options' => $options]);
    }
}