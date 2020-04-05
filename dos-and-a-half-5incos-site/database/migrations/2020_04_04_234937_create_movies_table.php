<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('release_date')->nullable();
            $table->string('poster_path')->nullable();
            $table->timestamps();
        });

        Schema::create('episode_movie', function (Blueprint $table) {
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('episode_id');
            $table->timestamps();
            $table->primary(["episode_id", "movie_id"]);
        });

        Schema::table('episode_movie', function (Blueprint $table) {
            $table->foreign("movie_id")->references("id")->on('movies');
            $table->foreign('episode_id')->references('id')->on('episodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
