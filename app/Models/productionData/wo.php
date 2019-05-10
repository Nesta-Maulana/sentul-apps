<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class wo extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'wo';
	protected $guarded 		= ['id'];
	public function produk()
	{
        return $this->belongsTo('App\Models\masterApps\produk', 'produk_id');
    }
    public function rpdFillingHead()
    {
        return $this->belongsTo('App\Models\productionData\rpdFillingHead', 'rpd_filling_head_id');
    }
}
