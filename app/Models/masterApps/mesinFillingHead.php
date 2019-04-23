<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFillingHead extends Model
{
	protected $connection = 'mysql4';	
    protected $table = 'kelompok_mesin_filling_head';
    protected $guarded = ['id'];
}
