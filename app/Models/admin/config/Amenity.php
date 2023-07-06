<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Amenity extends Model implements TranslatableContract
{
    //use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['icon','photo','photo_thum_1'];
    protected $table = "amenities";
    protected $primaryKey = 'id';
}
