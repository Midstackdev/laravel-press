<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {   
        /**
         * Run the migrations.
         *
         * @return void
         */
         Schema::create('posts', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier')->index();
            $table->string('slug')->unique()->index();
            $table->string('title')->index();
            $table->text('body');
            $table->text('extra');
            $table->timestamps();

            $table->index('created_at');
            $table->index('updated_at');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('posts');
    }
}