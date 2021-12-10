<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    protected $dates = ['date'];
    public static $rules = array(
        'user_id' => 'required',
        'shop_id' => 'required',
        'day' => 'required',
        'time' => 'required',
        'number_of_people' => 'required',
        'payment' => 'required'
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
