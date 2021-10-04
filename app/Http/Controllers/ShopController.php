<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        
        $items = Shop::with(['area','category','favorites' => function($query){
            $query->where('user_id',Auth::id());
        }])->get();
        $user = Auth::user();
        return view('auth.home')->with(['items' => $items,'user' => $user]);
    }
    public function getData(Request $request)
    {
        $item = Shop::find($request->id);
        $user = Auth::user();
        return view('auth.datail',['item' => $item,'user' => $user]);
    }
}
