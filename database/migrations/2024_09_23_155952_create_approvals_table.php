<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests');
            $table->boolean('is_approve');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('approvals');
    }
};
