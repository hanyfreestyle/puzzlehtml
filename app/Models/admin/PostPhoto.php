<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;

    protected $table = "post_photos";
    protected $primaryKey = 'id';

    public function postName(){
        return $this->belongsTo(Post::class,"post_id");
    }
}
