<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    protected $connection = 'utility_online';
    protected $table="satuan";
    protected $fillable=['satuan', 'status'];
}
