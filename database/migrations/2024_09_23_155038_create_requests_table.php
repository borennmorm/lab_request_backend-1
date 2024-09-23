<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained('labs');
            $table->foreignId('session_id')->constrained('sessions');
            $table->foreignId('user_id')->constrained('users');
            $table->date('request_date');
            $table->string('major', 100)->nullable();
            $table->string('subject', 100)->nullable();
            $table->integer('generation')->nullable();
            $table->string('software_need', 255)->nullable();
            $table->integer('number_of_student')->nullable();
            $table->text('additional')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
