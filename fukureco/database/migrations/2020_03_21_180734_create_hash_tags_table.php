<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });

        Schema::create('hash_tag_post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hash_tag_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('hash_tag_id')->references('id')->on('hash_tags')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hash_tags');
        Schema::dropIfExists('hash_tag_post');
    }
}
