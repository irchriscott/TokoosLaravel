<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function adminLogin() {
        return view('admin.login');
    }

    public function index(Request $request) {
        return view('admin.index');
    }
}
