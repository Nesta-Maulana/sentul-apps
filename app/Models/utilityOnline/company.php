<?php

namespace App\Models\utilityOnline;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = "company";
    protected $fillable = ['company', 'status'];
}
