<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('config_lang_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group')->nullable();
            $table->string('sub_dir')->nullable();
            $table->string('lang_key');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_lang_files');
    }
};
