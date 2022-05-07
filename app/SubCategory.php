<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{

    use SoftDeletes;

    public $table = 'sub_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'icon', 'is_best', 'status', 'cat_id', 'duration', 'description', 'for_who', 'preparation_time', 'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = ['imageUri', 'currency'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }
    public function Category()
    {
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }

    public function getCurrencyAttribute()
    {
        return AdminSetting::first()->currency_symbol;
    }
}
