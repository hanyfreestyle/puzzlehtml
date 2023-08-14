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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("slug_count")->default(0);

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->unsignedBigInteger('listing_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();

            $table->string("slug");
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("slider_images_dir")->nullable();

            $table->integer("slider_get")->default(0);


            $table->boolean("is_published")->default(true);
            $table->dateTime("published_at")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
