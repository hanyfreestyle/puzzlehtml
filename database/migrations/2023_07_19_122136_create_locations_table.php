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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string("slug")->unique();
            $table->integer("sort_order")->nullable();
            $table->double("latitude")->nullable();
            $table->double('longitude')->nullable();
            $table->string('projects_type')->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->boolean("is_active")->default(true);
            $table->boolean("is_searchable")->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('locations');

            $table->index("slug");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
