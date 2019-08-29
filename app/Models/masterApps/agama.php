<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class agama extends Model
{
	protected $connection = 'master_apps';
	protected $table="agama";
 	protected $guarded = ['id'];

}
 