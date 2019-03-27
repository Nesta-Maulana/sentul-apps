<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class penggunaan extends Model
{
    protected $connection = 'mysql2';
    protected $table="penggunaan";
    protected $fillable=['id_bagian', 'nilai', 'tgl_penggunaan'];
}
