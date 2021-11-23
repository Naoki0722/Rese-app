<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function addReserve(ReserveRequest $request)
    {
        
        $form = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'date' => $request->day.$request->time,
            'number_of_people' => $request->number_of_people
        ];
        Reserve::create($form);
        $user = Auth::user();
        return view('auth.done',['user' => $user]);
    }
    
    public function myPage()
    {
        $reservedShops = Reserve::where('user_id', Auth::id())->with('shop')->get();
        $favorites = Favorite::where('user_id', Auth::id())->with('shop.area','shop.category')->get();
        $user = Auth::user();
        return view('auth.mypage',['reservedShops' => $reservedShops, 'favorites' => $favorites, 'user' => $user]);
    }

    public function delete(Request $request)
    {
        Reserve::find($request->id)->delete();
        return back();
    }

    public function getChange(Request $request)
    {
        $item = Reserve::where('id',$request->id)->with('shop')->get();
        $user = Auth::user();
        return view('auth.reservationchange',['item' => $item,'user' => $user]);
    }

    public function update(ReserveRequest $request)
    {
        $form = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'date' => $request->day.':'.$request->time,
            'number_of_people' => $request->number_of_people
        ];
        Reserve::where('id',$request->id)->update($form);
        $user = Auth::user();
        return view('auth.changecompleted',['user' => $user]);
    }

    public function showQr(Request $request)
    {
        $item = Reserve::where('id',$request->id)->with('shop','user')->get();
        $user = Auth::user();
        return view('auth.showqr', ['item' => $item, 'user' => $user]);
    }

    public function reservationDatails(Request $request)
    {
        $item = Reserve::where('id',$request->id)->with('shop','user')->get();
        return view('auth.reservationdatails',['item' => $item]);
    }
}
