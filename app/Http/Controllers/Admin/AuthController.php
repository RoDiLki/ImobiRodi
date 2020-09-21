<?php

namespace ImobiRodi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ImobiRodi\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.index');
    }
}
