<?php

namespace App\Models\admin\config;

use App\Models\admin\Amenitable;
use App\Models\admin\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cache ;

class Amenity extends Model implements TranslatableContract
{
    //use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['icon','photo','photo_thum_1'];
    protected $table = "amenities";
    protected $primaryKey = 'id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     cash_amenities
    static function cash_amenities()
    {
        $amenities = Cache::remember('amenities_list_cash',config('app.amenities_list_cash_time'), function (){
            return  Amenity::with('translations')->get();
        });
        return $amenities ;
    }


}
