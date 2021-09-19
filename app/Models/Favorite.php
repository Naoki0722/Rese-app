<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    public static $rules = array(
        'user_uid' => 'required',
        'shop_id' => 'required',
    );

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shops()
    {
        return $this->belongsTo('App\Models\Shop');
    }
    
}
