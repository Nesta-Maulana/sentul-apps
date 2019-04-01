<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class hakAksesAplikasi extends Model
{
    protected $table = 'hak_akses_menu';
    protected $fillable = ['user_id','menu_id', 'lihat','tambah',  'ubah', 'hapus'];
}
