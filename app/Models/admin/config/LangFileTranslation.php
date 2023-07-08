<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangFileTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "config_lang_file_translations";
    protected $fillable = ['name','lang_id'];
    protected $primaryKey = 'id';

}
