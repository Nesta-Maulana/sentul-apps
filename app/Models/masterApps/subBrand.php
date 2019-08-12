<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class subBrand extends Model
{
    protected $connection = 'production_data';
    protected $table = 'sub_brand';
    protected $guarded = ['id'];
    public function brand(){
        return $this->belongsTo('App\Models\masterApps\brand', 'brand_id');
    }
}
