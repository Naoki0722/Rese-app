<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;


class OwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $item = Shop::where('owner_id',Auth::id())->get();
        return view('auth.owner',['user' => $user,'item' => $item]);
    }
}
