<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class mesinFilling extends Model
{
	protected $connection = 'mysql4';
    protected $table = "mesin_filling";
    protected $guarded = ['id'];
}
