<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('name');
            $table->string('color')->default('color');
            $table->string('currency')->default('US Dollar');
            $table->string('currency_sign')->default('$');
            $table->string('user_registration')->default(0);
            $table->string('email_verification')->default(0);
            $table->string('sms_verification')->default(0);
            $table->string('sms_api')->default('sms_api');
            $table->string('mail_from')->default('mail_from_address');
            $table->string('mail_template')->default('mail_template');
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
        Schema::dropIfExists('settings');
    }
}
