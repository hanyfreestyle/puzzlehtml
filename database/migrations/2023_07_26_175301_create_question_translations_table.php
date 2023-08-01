<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('question_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->string('locale')->index();
            $table->string('question')->nullable();
            $table->text('answer')->nullable();

            $table->unique(['question_id','locale']);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('question_translations');
    }
};
