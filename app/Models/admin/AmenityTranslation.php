<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];
}
