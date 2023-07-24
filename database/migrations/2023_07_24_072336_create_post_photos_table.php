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
        Schema::create('post_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->unsigned();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->string("file_extension")->nullable();
            $table->integer("file_size")->nullable();
            $table->integer("file_h")->nullable();
            $table->integer("file_w")->nullable();
            $table->integer("position")->default(0);
            $table->integer("is_default")->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_photos');
    }
};
