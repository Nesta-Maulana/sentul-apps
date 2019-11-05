<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;
use App\Models\masterApps\formDetail;

class formHead extends Model
{
    protected $connection = 'master_apps';
    protected $table = 'form_head';
    protected $guarded = ['id'];

    public function formDetail(){
        return $this->hasMany('App\Models\masterApps\formDetail','head_id', 'id' );
    }
}
