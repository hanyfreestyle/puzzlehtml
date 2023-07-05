<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFilter extends Model
{
    use HasFactory;
    protected $table = "config_upload_filters";

    public function FiltersSize(){
        return $this->hasMany(UploadFilterSize::class,'filter_id','id');
    }
}
