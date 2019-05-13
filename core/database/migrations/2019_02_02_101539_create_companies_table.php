<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('roi')->default('1');
            $table->string('roi_color')->default('green');
            $table->string('status_color')->default('red');
            $table->string('preview')->nullable();
            $table->string('total_investment');
            $table->string('withdrawal_type');
            $table->string('deposit_min');
            $table->string('first_monitored')->nullable();
            $table->string('number_monitor')->nullable();
            $table->string('payment_last');
            $table->string('feature_id')->nullable();
            $table->string('medium_id')->nullable();
            $table->string('status');
            $table->string('online_days')->nullable();
            $table->string('rating');
            $table->string('referral');
            $table->string('contact_number');
            $table->text('description');
            $table->string('category_id');

            $table->tinyInteger('publish')->nullable()->default(0);
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
        Schema::dropIfExists('companies');
    }
}
