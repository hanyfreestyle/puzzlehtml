<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('config_lang_paths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('admin');
            $table->string('group')->nullable();
            $table->string('sub_dir')->nullable();
            $table->string('file_name')->nullable();
            //$table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_lang_paths');
    }
};
