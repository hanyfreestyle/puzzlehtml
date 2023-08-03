<?php

namespace App\Models\admin;

use App\Constants\Fields;
use App\Helpers\AdminHelper;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    public array $translatedAttributes = ['name','g_title','g_des','body_h1','breadcrumb'];
    protected $table = "listings";
    protected $primaryKey = 'id';



    protected function amenity() :Attribute{
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }


//    protected function slug() :Attribute{
//        return Attribute::make(
//            get: fn($value) => AdminHelper::Url_Slug($value),
//            set: fn($value) => AdminHelper::Url_Slug($value),
//        );
//    }


//    protected array $dates = ['delivery_date'];
//    protected $casts = [
//        'delivery_date'=> 'datetime'
//    ];
//
//    public function getDate()
//    {
//        return $this->delivery_date->format('Y');
//    }

    public function setPublished(bool $status = true): self
    {
        return $this->setAttribute('is_published', $status);
    }







    public function developerName() :BelongsTo
    {
        return $this->belongsTo(Developer::class,'developer_id','id');
    }

    public function locationName():BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }


    public function getoldtools() :HasMany
    {
        return $this->hasMany(Amenitable::class,'amenitable_id','id');
    }



    public function scopeProject(Builder $query): Builder
    {
        return $query->where('listing_type','Project');
    }

    public function scopeUnit(Builder $query): Builder
    {
        return $query->where('listing_type','Unit');
    }

    public function scopeForSale(Builder $query): Builder
    {
        return $query->where('listing_type','ForSale');
    }





    public function get_more_photo():HasMany
    {
        return $this->hasMany(ListingPhoto::class,'listing_id','id');
    }

    public function get_units_to_project():HasMany
    {
        return $this->hasMany(Listing::class,'parent_id','id');
    }
    public function faq_to_project():HasMany
    {
        return $this->hasMany(Question::class,'project_id','id');
    }

}
