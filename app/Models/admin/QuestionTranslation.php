<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "question_translations";
    protected $fillable = ['question','answer'];


}
