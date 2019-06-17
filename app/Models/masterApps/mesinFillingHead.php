<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFillingHead extends Model
{
	protected $connection = 'mysql4';	
    protected $table = 'kelompok_mesin_filling_head';
    protected $guarded = ['id'];
    public function mesinFillingDetail()
    {
    	return $this->hasMany('App\Models\masterApps\mesinFillingDetail','kelompok_mesin_filling_head_id','id');
    }
    
}
