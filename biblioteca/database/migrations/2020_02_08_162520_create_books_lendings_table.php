<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_lendings', function (Blueprint $table) {
            $table->integer('lending_id')->unsigned();
            $table->integer('book_id')->unsigned();
        });

        Schema::table('books_lendings', function(Blueprint $table) {
            $table->foreign('lending_id')->references('id')->on('lendings');
            $table->foreign('book_id')->references('id')->on('books');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_lendings');
    }
}
