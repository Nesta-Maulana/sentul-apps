<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['parent_id', 'menu','icon','link','aplikasi_id','status','posisi'];

}
