<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function addReserve(Request $request)
    {
        $this->validate($request,Reserve::$rules);
        
        $form = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'date' => $request->day.':'.$request->time,
            'number_of_people' => $request->number_of_people
        ];
        Reserve::create($form);
        return view('auth.done');
    }
    
    public function myPage()
    {
        $reservedShops = Reserve::where('user_id', Auth::id())->with('shop')->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $user = Auth::user();
        return view('auth.mypage',['reservedShops' => $reservedShops, 'favorites' => $favorites, 'user' => $user]);
    }
}
