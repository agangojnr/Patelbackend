<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{

    use SoftDeletes;

    public $table = 'branch';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $guarded = [];

    protected $withCount = ['reviews'];
    protected $appends = ['imageUri', 'avg_rating'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = implode(',', $value);
    }

    public function getCategoryAttribute($value)
    {
        return explode(',', $value);
    }
    public function setManagerAttribute($value)
    {
        $this->attributes['manager'] = implode(',', $value);
    }

    public function getManagerAttribute($value)
    {
        return explode(',', $value);
    }
    public function setEmployeeAttribute($value)
    {
        $this->attributes['employee'] = implode(',', $value);
    }

    public function getEmployeeAttribute($value)
    {
        return explode(',', $value);
    }
    public function getAvgRatingAttribute()
    {

        $revData = Review::where('branch_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');
        if ($star > 1) {
            $t = $star / count($revData);
            return number_format($t, 1, '.', '');
        }
        return 0;
    }

    public function Reviews()
    {
        return $this->hasMany('App\Review', 'branch_id', 'id')->orderBy('created_at', 'desc');
    }
}
