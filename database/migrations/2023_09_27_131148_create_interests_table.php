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
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('football')->default(0);
            $table->integer('basketball')->default(0);
            $table->integer('volleyball')->default(0);
            $table->integer('table_tennis')->default(0);
            $table->integer('swimming')->default(0);
            $table->integer('workout')->default(0);
            $table->integer('riding')->default(0);
            $table->integer('drawing')->default(0);
            $table->integer('movies')->default(0);
            $table->integer('gaming')->default(0);
            $table->integer('travelling')->default(0);
            $table->integer('music')->default(0);
            $table->integer('walking')->default(0);
            $table->integer('baseball')->default(0);
            $table->integer('skiing')->default(0);
            $table->integer('bowling')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
