<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{

    use Translatable;
    public $translatedAttributes = ['name', 'g_title','g_des','closed_mass'];
    protected $fillable = ['facebook', 'twitter','youtube','instagram','google_api'];
    protected $table = "settings";
    protected $primaryKey = 'id';
    public $timestamps = false ;




}
