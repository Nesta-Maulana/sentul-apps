<?php

namespace App\productionData;

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
    
}
