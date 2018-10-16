<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('funeral_home_id')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('campaign_end')->nullable();
            $table->integer('steps_completed')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->string('goal')->nullable();
            $table->text('campaign_story')->nullable();
            $table->string('referrer_name')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
