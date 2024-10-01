<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $flimCount = DB::table('products')->where('categories_id', 1)->count();
        $nonflimCount = DB::table('products')->where('categories_id', 2)->count();
        return view('backend.pages.dashboard.index', compact('flimCount', 'nonflimCount'));
    }
}
