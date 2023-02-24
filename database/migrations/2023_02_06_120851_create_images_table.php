<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up() {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->foreignId('idmovie');
            
            $table->foreign('idmovie')->references('id')->on('movie')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('image');
    }
};
