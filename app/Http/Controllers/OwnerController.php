<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Reserve;
use Storage;


class OwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = Shop::where('owner_id',Auth::id())->get();
        $areas = Area::all();
        $categories = Category::all();
        return view('auth.owner',['user' => $user,'items' => $items,'areas' => $areas,'categories' => $categories]);
    }

    public function shopCreate(ShopRequest $request)
    {
        $img = $request->img;
        $path = Storage::disk('s3')->putFile('myprefix', $img, 'public');
        $form = [
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'category_id' => $request->category_id,
            'overview' => $request->overview,
            'img' => Storage::disk('s3')->url($path),
            'owner_id' => $request->owner_id,
        ];
        Shop::create($form);
        $user = Auth::user();
        return view('auth.shopcreate',['user' => $user]);
    }

    public function shopUpdate(Request $request)
    {
        $items = Shop::find($request->id);
        $user = Auth::user();
        $areas = Area::all();
        $categories = Category::all();
        return view('auth.shopupdate',['items' => $items,'user' => $user,'areas' => $areas,'categories' => $categories]);
    }

    public function shopInfoUpdate(ShopRequest $request)
    {
        $img = $request->img;
        $path = Storage::disk('s3')->putFile('myprefix', $img, 'public');
        $form = [
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'category_id' => $request->category_id,
            'overview' => $request->overview,
            'img' => Storage::disk('s3')->url($path),
            'owner_id' => $request->owner_id,
        ];
        Shop::where('id',$request->id)->update($form);
        $user = Auth::user();
        return view('auth.updatecompleted',['user' => $user]);
    }

    public function getReservation(Request $request)
    {
        $items = Reserve::where('shop_id',$request->id)->with('user')->get();
        $user = Auth::user();
        $shop = Shop::find($request->id);
        return view('auth.reservationinfo',['items' => $items,'user' => $user,'shop' => $shop]);
    }
}
