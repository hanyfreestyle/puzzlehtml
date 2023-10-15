<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('getslider')->nullable();
            $table->integer('lang')->default(0);
            $table->enum('listing_type',['Unit','Project','ForSale']);

            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->string("slug")->unique();
            $table->string("slider_images_dir")->nullable();
            $table->integer("slider_active")->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();

            $table->string("youtube_url")->nullable();
            $table->integer("price")->nullable();
            //$table->string("contact_number")->nullable();

            $table->integer("area")->nullable();
            $table->integer("baths")->nullable();
            $table->integer("rooms")->nullable();
            $table->integer("unit_status")->nullable();

            $table->enum("status", ['under-construction','completed'])->nullable();
            $table->enum("project_type", ['residential','vacation','commercial','medical'])->nullable();
            $table->integer("units_count")->default(0);
            $table->enum("property_type", ['apartment','duplex','studio','town-house','twin-house','pent-house','villa','office','store','chalet','chalet-with-garden','pharmacy','clinic','laboratory'])->nullable();
            $table->enum("view", ['main-street','seaview','lakeview','nileview'])->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('delivery_date')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->json('amenity')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('parent_id')->references('id')->on('listings')->onDelete('cascade');

            $table->index("slug");
            $table->index("developer_id");
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }


};
