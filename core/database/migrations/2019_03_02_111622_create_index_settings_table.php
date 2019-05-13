<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('index_image')->nullable()->default('none');
            $table->string('index_heading')->nullable()->default('none');
            $table->string('learn_more_link')->nullable()->default('#');

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
        Schema::dropIfExists('index_settings');
    }
}
