<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Event;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        return view('app');
    }
}
