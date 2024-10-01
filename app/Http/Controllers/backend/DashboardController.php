<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index(){
        $contactCount = Contact::count();
        return view('backend.pages.dashboard.index', compact('contactCount'));
    }
}
