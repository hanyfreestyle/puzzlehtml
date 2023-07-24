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
        Schema::create('post_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('post_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('body_h1')->nullable();
            $table->string('breadcrumb')->nullable();

            $table->unique(['post_id','locale']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_translations');
    }
};
