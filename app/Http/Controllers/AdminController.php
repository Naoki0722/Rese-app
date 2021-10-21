<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.admin',['user' => $user]);
    }

    public function addOwner(UserRequest $request)
    {
        $form = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];
        User::create($form);
        return view('auth.addownercompleted');
    }
}
