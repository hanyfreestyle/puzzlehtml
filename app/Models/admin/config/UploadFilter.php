<?php

namespace App\Models\admin\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cache;

class UploadFilter extends Model
{
    use HasFactory;
    protected $table = "config_upload_filters";

    public function FiltersSize(){
        return $this->hasMany(UploadFilterSize::class,'filter_id','id');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     cash_UploadFilter
    static function cash_UploadFilter()
    {
        $upload_filter = Cache::remember('upload_filter_list_cash',config('app.upload_filter_list_cash_time'), function (){
            return  UploadFilter::get();
        });
        return $upload_filter ;
    }

}
