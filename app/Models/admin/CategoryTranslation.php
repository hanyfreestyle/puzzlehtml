<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = "category_translations";
    protected $fillable = ['name'];
}
