<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumImageTable extends Migration
{

    public function up()
    {
        Schema::create('album_image', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('album_id');
			$table->unsignedInteger('image_id');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('album_image');
    }
}
