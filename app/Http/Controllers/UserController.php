<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('prenom')->paginate(12);

        return view('admin.users.index', compact('users'));
    }
}
