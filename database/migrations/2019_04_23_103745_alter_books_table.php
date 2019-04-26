<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedInteger('genre_id')->nullable(); // UNSIGNED INTEGER car un livre peut ne pas avoir de genre

            // Contrainte référencé sur la table genres.id
            // genre_id correspond à la table genres => colonne id
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_genre_id_foreign');
            $table->dropColumn('genre_id');
        });
    }
}
