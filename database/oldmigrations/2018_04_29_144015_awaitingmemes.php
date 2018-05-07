<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Awaitingmemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('awaitingmemes', function (Blueprint $table) {
          $table->increments('id');
          $table->string('author');
          $table->string('title');
          $table->string('category');
          $table->boolean('tags');
          $table->string('meme');
          //$table->boolean('comments');
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
