<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('subtitle')->nullable();

            $table->longText('short_text')->nullable();

            $table->longText('full_text')->nullable();

            $table->unsignedInteger('category_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');

            $table->string('author')->nullable();

            $table->string('created_by')->references('id')->on('users');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
