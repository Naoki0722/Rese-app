<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required',
        'area_id' => 'required',
        'category_id' => 'required',
        'overview' => 'required',
        'img' => 'required',
    );

    public function reserves()
    {
        return $this->hasMany('App\Models\Reserve');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function areas()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function categories()
    {
        return $this->belonsTo('App\Mpdels\Category');
    }
}
