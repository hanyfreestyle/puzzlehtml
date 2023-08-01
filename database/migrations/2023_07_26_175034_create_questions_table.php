<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->unsigned();

            $table->foreign('project_id')->references('id')->on('listings')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();


        });
    }
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }

};
