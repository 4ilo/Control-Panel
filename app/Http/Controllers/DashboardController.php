<?php

namespace App\Http\Controllers;

use App\Output;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $outputs = Output::all()->chunk(3);

        return view('dashboard', compact('outputs'));
    }
}
