<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;


    public $translatedAttributes = ['question','answer'];
    protected $fillable = ['project_id'];
    protected $table = "questions";
    protected $primaryKey = 'id';

}
