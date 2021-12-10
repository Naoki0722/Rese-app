<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Menu;
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
        $item = Shop::with('area','category')->find($request->id);
        $menus = Menu::where('shop_id',$request->id)->get();
        $user = Auth::user();
        
        return view('auth.datail',['item' => $item,'user' => $user,'menus'=> $menus]);
    }
}
