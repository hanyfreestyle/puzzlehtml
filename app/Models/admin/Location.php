<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1','is_active'];
    protected $table = "locations";
    protected $primaryKey = 'id';


    public function setActive(bool $status = true): self
    {
        return $this->setAttribute('is_active', $status);
    }

    public function setSearchable(bool $status = true): self
    {
        return $this->setAttribute('is_searchable', $status);
    }


    public function locations()
    {
        return $this->hasMany(Location::class,'parent_id');
    }

    public function childrenlocations()
    {
        return $this->hasMany(Location::class,'parent_id')->with('locations');
    }


    public function parentName()
    {
       // return $this->hasOne(Location::class,'id');
        return $this->belongsTo(Location::class,'parent_id','id');
    }



    public function getProjectToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('parent_id','=',null)
            ->where('property_type','=',null);
    }

    public function getProjectUnitsToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('parent_id','!=',null)
            ->where('property_type','!=',null);
    }


    public function getUnitsForSaleToLocation()
    {
        return $this->hasMany(Listing::class,'location_id', 'id')
            ->where('parent_id','=',null)
            ->where('property_type','!=',null);
    }

}
