<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','des','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1'];
    protected $table = "posts";
    protected $primaryKey = 'id';


    public function getMorePhoto(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostPhoto::class,'post_id','id');
    }


    public function setPublished(bool $status = true): self
    {
        return $this->setAttribute('is_published', $status);
    }


    public function getCatName()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getLoationName()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }


    public function seoDes():string
    {
        $str = $this->des ;
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', ' ', $str);
       # return Str::words($str,500);
        return Str::limit($str,160);
    }



    public function teans_en()
    {
        return $this->hasOne(PostTranslation::class,'post_id','id')
            ->where('locale','en');

    }

    public function teans_ar()
    {
        return $this->hasOne(PostTranslation::class,'post_id','id')
            ->where('locale','ar');

    }

}
