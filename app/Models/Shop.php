<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    protected $fillable = array(
        'shop_name',
        'area_id',
        'category_id',
        'overview',
        'img',
        'owner_id',
);
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

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
