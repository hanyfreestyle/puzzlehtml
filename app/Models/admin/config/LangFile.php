<?php

namespace App\Models\admin\config;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangFile extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['group','sub_dir','lang_key'];
    protected $table = "config_lang_files";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'lang_id' ;


}
