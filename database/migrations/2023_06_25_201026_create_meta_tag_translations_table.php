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
        Schema::create('meta_tag_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('meta_tag_id')->unsigned();
            $table->string('locale')->index();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('body_h1')->nullable();
            $table->string('breadcrumb')->nullable();

            $table->unique(['meta_tag_id','locale']);
            $table->foreign('meta_tag_id')->references('id')->on('meta_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_tag_translations');
    }
};
