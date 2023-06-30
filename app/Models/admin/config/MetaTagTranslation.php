<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTagTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['g_title','g_des','body_h1','breadcrumb'];
}
