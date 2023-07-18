<?php

namespace App\Models\admin;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['photo','photo_thum_1'];
    protected $table = "categories";
    protected $primaryKey = 'id';


    public function setActive(bool $status = true): self
    {
        return $this->setAttribute('is_active', $status);
    }

    public function hanydarwish(){
        return self::orderBy('id')->get();

    }

}
