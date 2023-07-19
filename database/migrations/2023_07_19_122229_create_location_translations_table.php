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
        Schema::create('location_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('location_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('body_h1')->nullable();
            $table->string('breadcrumb')->nullable();
            $table->softDeletes();

            $table->unique(['location_id','locale']);
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_translations');
    }
};
