<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $connection = 'mysql4';
    protected $table = "produk";
    protected $guarded = ['id'];
    public function brand(){
        return $this->belongsTo('App\Models\masterApps\brand', 'brand_id');
    }
    public function jenisProduk(){
        return $this->belongsTo('App\Models\masterApps\jenisProduk', 'jenis_produk_id');
    }
    public function mesinFillingHead(){
        return $this->belongsTo('App\Models\masterApps\mesinFillingHead', 'kelompok_mesin_filling_head_id');
    }
}
