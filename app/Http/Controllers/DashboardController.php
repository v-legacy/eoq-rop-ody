<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {

        $title = 'Halaman Dashboard';

        return view('pages.dashboard.index', ['title' => $title]);
    }
}
