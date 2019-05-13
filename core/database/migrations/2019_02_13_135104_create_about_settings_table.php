<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('about_image')->nullable()->default('none');
            $table->string('mission_image')->nullable()->default('none');
            $table->string('business_image')->nullable()->default('none');
            $table->string('about_heading')->nullable()->default('none');
            $table->string('mission_heading')->nullable()->default('none');
            $table->string('business_heading')->nullable()->default('none');
            $table->text('mission_description')->nullable();
            $table->text('business_description')->nullable();
            
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
        Schema::dropIfExists('about_settings');
    }
}
