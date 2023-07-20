<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "developer_translations";
    protected $fillable = ['name'];
}
