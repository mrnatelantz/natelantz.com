<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('slug');
            $table->string('name')->nullable();
            $table->string('cover_image')->nullable();
            $table->longText('head')->nullable();
            $table->longText('content')->nullable();
            $table->longText('foot')->nullable();
            $table->string('template')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page_versions');
    }
}
