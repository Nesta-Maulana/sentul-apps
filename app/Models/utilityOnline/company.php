<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
	protected $connection = 'production_data';
    protected $table = "company";
    protected $fillable = ['company', 'status', 'singkatan'];
    public function brand()
    {
    	return $this->hasMany('App\Models\masterApps\brand');

    }
}
