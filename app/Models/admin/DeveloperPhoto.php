<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperPhoto extends Model
{
    use HasFactory;

    protected $table = "developer_photos";
    protected $primaryKey = 'id';



    public function developerName(){
        return $this->belongsTo(Developer::class,"developer_id");
    }

}
