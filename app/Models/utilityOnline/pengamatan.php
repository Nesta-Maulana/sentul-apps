<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class pengamatan extends Model
{
    protected $connection = 'mysql2';
    protected $table="pengamatan";
    protected $fillable=['id_bagian', 'nilai_meteran', 'user_id', 'user_update'];
}
