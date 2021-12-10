<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    protected $fillable = array(
        'menu_name',
        'shop_id',
        'price',
    );
    public static $rules = array(
        'menu_name' => 'required',
        'shop_id' => 'required',
        'price' => 'required',
    );

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
}

