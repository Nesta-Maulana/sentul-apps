<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFillingDetail extends Model
{
	protected $connection = 'mysql4';
    protected $table = 'kelompok_mesin_filling_detail';
    protected $guarded = ['id'];
}