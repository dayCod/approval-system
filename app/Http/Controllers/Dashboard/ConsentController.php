<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function index()
    {
        return view('page.dashboard.consent.index');
    }
}
