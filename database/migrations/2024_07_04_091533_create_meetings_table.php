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
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->string('place');
            $table->time('time_start');
            $table->time('time_end');
            $table->integer('duration');
            $table->string('lecture_nim');
            $table->foreign('lecture_nim')
                ->references('nim')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
