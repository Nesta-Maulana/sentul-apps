<?php

namespace App\Models\masterApps;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $connection = 'master_apps';
	protected $table="list_activity";
    protected $guarded = ["id"];

    public function Kategoribd(){
        return $this ->belongsTo('App\Models\masterApps\Kategoribd', 'id', 'list_activity_id');
    }
}

