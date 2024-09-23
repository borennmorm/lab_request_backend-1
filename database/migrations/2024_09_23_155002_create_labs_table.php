<?php

// 1. Create Labs Table
// database/migrations/2024_09_23_000001_create_labs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('building', 50)->nullable();
            $table->boolean('lab_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labs');
    }
};
