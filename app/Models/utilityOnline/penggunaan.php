<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class penggunaan extends Model
{
    protected $connection = 'utility_online';
    protected $table="penggunaan";
    protected $guarded=['id'];

    public function bagian(){
        return $this->belongsTo('App\Models\utilityOnline\bagian', 'id_bagian');
    }
}
