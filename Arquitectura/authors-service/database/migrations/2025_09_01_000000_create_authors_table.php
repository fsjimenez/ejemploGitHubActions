<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id(); // Esto crea un unsignedBigInteger
            $table->string('name');
            $table->string('country')->nullable();
            $table->timestamps();
        
            // Configuración de charset y collation
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        
        
        
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
}