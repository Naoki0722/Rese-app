<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Reserve;
use App\Models\User;
use App\Http\Requests\MailRequest;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $address = User::find($request->id);
        $user = Auth::user();
        $shopName = $request->shop_name;
        return view('auth.mailform', ['address' => $address, 'user' => $user,'shopName' => $shopName]);
    }

    public function confirm(MailRequest $request)
    {
        $mail = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'shopName' => $request->shop_name,
            'name' => $request->name,
        ];
        $name = $request->name;
        $user = Auth::user();
        $request->session()->put('mail', $mail);
        return view('auth.confirm', ['name' => $name, 'mail' => $mail, 'user' => $user]);
    }

    public function send(Request $request)
    {
        $mail = $request->session()->get('mail');
        Mail::to($request->email)->send(new ContactMail($mail));
        $request->session()->forget('mail');
        $user = Auth::user();
        return view('auth.sendcompletely', ['user'=>$user]);
    }
}
