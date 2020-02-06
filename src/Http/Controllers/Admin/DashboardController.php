<?php

namespace Sanjok\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        # code...
        //return "dashboard";
        return view('Blog::index');
    }
}
