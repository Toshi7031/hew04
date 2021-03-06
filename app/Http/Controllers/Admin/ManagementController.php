<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/management',compact('users'));
    }
}
