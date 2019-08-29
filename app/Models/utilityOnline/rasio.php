<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class rasio extends Model
{
    protected $connection = 'utility_online';
    protected $table="rasio_detail";
    protected $fillable=['rasio_head_id', 'company_id', 'nilai'];

    public function rasioHead(){
        return $this->belongsTo('App\Models\utilityOnline\rasioHead', 'rasio_head_id');
    }
    public function company(){
        return $this->belongsTo('App\Models\utilityOnline\company', 'company_id');
    }
}
