<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFillingDetail extends Model
{
	protected $connection = 'production_data';
    protected $table = 'kelompok_mesin_filling_detail';
    protected $guarded = ['id'];
    public function mesinFilling()
    {
    	return $this->belongsTo('App\Models\masterApps\mesinFilling','mesin_filling_id');
    }
}
