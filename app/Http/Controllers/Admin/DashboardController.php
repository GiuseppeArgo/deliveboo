<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('admin.dashboard',compact('user'))->with('message', 'benvenuto/a ciao');
    }
}
