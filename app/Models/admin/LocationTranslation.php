<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = "location_translations";
    protected $fillable = ['name'];

}
