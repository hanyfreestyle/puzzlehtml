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
        Schema::create('amenity_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('amenity_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['amenity_id','locale']);
            $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_translations');
    }
};
