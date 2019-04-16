<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $connection = 'mysql2';
    protected $table="kategori";
    protected $fillable=['kategori','status'];
}
