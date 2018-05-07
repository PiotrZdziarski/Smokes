<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Memes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('memes', function (Blueprint $table) {
          $table->increments('id');
          $table->string('author');
          $table->string('category');
          $table->boolean('tags');
          $table->string('meme');
          //$table->boolean('comments');
          $table->integer('reported');
          $table->integer('likes');
          $table->integer('dislikes');
          $table->integer('all');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
