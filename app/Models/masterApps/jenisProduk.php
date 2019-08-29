<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class jenisProduk extends Model
{
	protected $connection = 'production_data';
    protected $table = 'jenis_produk';
    protected $guarded = ['id'];
}
