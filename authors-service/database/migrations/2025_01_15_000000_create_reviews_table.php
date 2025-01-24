<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->unsignedBigInteger('author_id'); // Clave foránea debe coincidir con authors.id
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade'); // Relación con authors
            $table->text('review_text'); // Texto de la reseña
            $table->integer('rating'); // Calificación de la reseña
            $table->timestamps();
        
            // Configuración de charset y collation
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        
        
    }

    /**
     * Revertir la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
