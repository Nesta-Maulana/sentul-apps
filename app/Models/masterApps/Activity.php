<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $connection = 'master_apps';
	protected $table="list_activity";
    protected $fillable = ["activity", "status"];
}
