<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "post_translations";
    protected $fillable = ['name'];

}
