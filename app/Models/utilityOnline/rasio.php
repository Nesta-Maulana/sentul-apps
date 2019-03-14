<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class rasio extends Model
{
    protected $connection = 'mysql2';
    protected $table="rasio_detail";
    protected $fillable=['rasio_head_id', 'company_id', 'nilai'];
}
