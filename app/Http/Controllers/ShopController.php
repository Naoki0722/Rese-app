<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        
        $items = Shop::with('area','category')->get();
        
        return view('auth.home',['items' => $items]);
    }
}
