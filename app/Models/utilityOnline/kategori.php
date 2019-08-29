<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $connection = 'utility_online';
    protected $table="kategori";
    protected $fillable=['kategori','status'];
}
