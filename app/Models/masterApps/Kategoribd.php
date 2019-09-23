<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Kategoribd extends Model
{
    protected $connection = 'master_apps';
	protected $table="kategori_bd";
    protected $guarded = ["id"];

    public function mesinFilling(){
        return $this->belongsTo('App\Models\masterApps\mesinFilling','mesin_filling_id', 'id' );
    }

    public function Activity(){
        return $this->belongsTo('App\Models\masterApps\Activity', 'list_activity_id', 'id' );
    }
}

