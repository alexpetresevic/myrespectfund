<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class InsertFeesPageIntoPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('pages')->insert(
            array(
                'title'      => 'Services Included',
                'body'       => '',
                'slug'       => 'fees',
                'created_at' => new \Carbon\Carbon(),
                'updated_at' => new \Carbon\Carbon(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('pages')->where('slug', '=', 'fees')->delete();
    }
}
