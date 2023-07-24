<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','g_title','g_des','body_h1','breadcrumb'];
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

}
