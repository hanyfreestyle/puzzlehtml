<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name','g_title','g_des','body_h1','breadcrumb'];
    protected $fillable = ['slug','photo','photo_thum_1','is_active'];
    protected $table = "developers";
    protected $primaryKey = 'id';


    public function setActive(bool $status = true): self
    {
        return $this->setAttribute('is_active', $status);
    }
}
