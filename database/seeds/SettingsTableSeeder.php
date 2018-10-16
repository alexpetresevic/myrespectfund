<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Settings::class)->create([
            'key'   => 'site_title',
            'value' => 'My Respects',
        ]);
    }
}
