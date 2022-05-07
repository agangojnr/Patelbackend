<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotDeal extends Model
{

    use SoftDeletes;

    public $table = 'hot_deals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $guarded = [];

    //protected $withCount = ['reviews'];
    protected $appends = ['imageUri'];

    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }

    public function appuser(){
        return $this->belongsTo('App\AppUsers', 'custodian');
    }

}
