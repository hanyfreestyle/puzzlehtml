<?php

namespace App\Models\admin\config;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MetaTag extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['cat_id'];
    protected $table = "meta_tags";
    protected $primaryKey = 'id';

}
