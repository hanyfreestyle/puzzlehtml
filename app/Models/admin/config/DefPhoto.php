<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefPhoto extends Model
{
    use HasFactory;
    protected $table = "config_def_photos";
    protected $fillable = ['cat_id','photo','postion','created_at','updated_at'];
}
