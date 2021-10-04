<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        $form = [
            'user_id' => Auth::id(),
            'shop_id' => $request->id,
        ];
        Favorite::create($form);
        return back();
    }

    public function delete(Request $request)
    {
        Favorite::find($request->id)->delete();
        return back();
    }
}
