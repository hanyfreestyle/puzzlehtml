<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "listing_translations";

}
