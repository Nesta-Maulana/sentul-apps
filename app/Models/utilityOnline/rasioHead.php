<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class rasioHead extends Model
{
    protected $connection = 'mysql2';
    protected $table="rasio_head";
    protected $fillable = ['bagian_id', 'status'];

    public function rasioDetail(){
        return $this->hasMany('App\Models\utilityOnline\rasio', 'rasio_head_id');
    }
}
