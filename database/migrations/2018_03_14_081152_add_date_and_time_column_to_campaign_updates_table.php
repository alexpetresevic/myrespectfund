<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateAndTimeColumnToCampaignUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campagn_updates', function (Blueprint $table){
            $table->date('date')->after('body')->nullable();
            $table->string('time')->after('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campagn_updates', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('time');
        });
    }
}
