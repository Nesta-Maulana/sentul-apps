<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use App\Models\masterApps\Kategoribd;

class Detail extends Model
{
    protected $connection = 'master_apps';
	protected $table="detail";
    protected $guarded = ["id"];

    public function Kategoribd(){
        return $this->hasMany('App\Models\masterApps\Kategoribd','kategori_bd_id', 'id' );
    }
}
