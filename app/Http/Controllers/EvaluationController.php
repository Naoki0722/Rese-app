<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EvaluationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluation;
use App\Models\Shop;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $items = Evaluation::where('shop_id',$request->id)->with('user')->get();
        $user = Auth::user();
        $shop = Shop::find($request->id);
        return view('auth.evaluation',['items' => $items,'user' => $user,'shop' => $shop]);
    }

    public function create(EvaluationRequest $request)
    {
        $form = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ];
        $shop = [
            'shop_id' => $request->shop_id
        ];
        $user = Auth::user();
        Evaluation::create($form);
        return view('auth.postingcompleted',['shop' => $shop,'user' => $user]);
    }
}
