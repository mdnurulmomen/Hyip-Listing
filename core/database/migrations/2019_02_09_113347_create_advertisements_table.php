<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('size');
            $table->string('url')->nullable();
            $table->string('preview')->nullable();
            $table->string('script')->nullable();
            $table->string('package_id')->nullable()->default('none');

            $table->string('end_time');
            $table->string('publisher_type')->nullable()->default('none');
            $table->string('publisher_id')->nullable()->default('none');
            $table->string('contact_number')->nullable()->default('none');

            $table->integer('views')->nullable()->default(0);
            $table->integer('clicked')->nullable()->default(0);

            $table->string('status')->nullable();

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
        Schema::dropIfExists('advertisements');
    }
}
