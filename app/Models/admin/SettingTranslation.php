<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = ['name', 'g_title','g_des','closed_mass'];
}
