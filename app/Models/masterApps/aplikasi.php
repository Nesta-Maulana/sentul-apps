<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class aplikasi extends Model
{
	protected $connection 	= 'master_apps';
    protected $table 		= "aplikasi";
    protected $guarded 		= ['id'];
}
