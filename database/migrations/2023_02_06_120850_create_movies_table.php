<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up() {
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->longText('description');
            $table->foreignId('idgenre');
            $table->foreignId('idformat');
            $table->double('price', 8, 2);
            $table->string('mainimage', 50);
            $table->integer('discs');
            $table->time('runtime');
            $table->enum('region', ['A', 'B', 'C', 'FREE'])->default('A');
            $table->enum('rating', ['G', 'PG', 'PG-13', 'R', 'NC-17'])->default('G');
            $table->year('date');
            $table->enum('closedcaptioned', ['No', 'Yes'])->default('No');
            $table->enum('language', ['English', 'French', 'Spanish', 'German', 'Portuguese'])->default('English');
            $table->enum('subtitles', ['English', 'French', 'Spanish', 'German', 'Portuguese'])->default('English');
            
            $table->timestamps();
            
            $table->foreign('idgenre')->references('id')->on('genre')->onDelete('cascade');
            $table->foreign('idformat')->references('id')->on('format')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('movie');
    }
};
