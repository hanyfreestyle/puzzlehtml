<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('listing_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('body_h1')->nullable();
            $table->string('breadcrumb')->nullable();

            $table->unique(['listing_id','locale']);
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('listing_translations');
    }

};
