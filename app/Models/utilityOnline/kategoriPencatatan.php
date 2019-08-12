<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class kategoriPencatatan extends Model
{
    protected $connection = 'utility_online';
    protected $table="kategori_pencatatan";
    protected $fillable=['kategori_pencatatan'];
}
