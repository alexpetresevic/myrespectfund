<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Page::class)->create([
            'title' => 'Privacy Policy',
            'slug'  => 'privacy-policy',
        ]);

        factory(App\Page::class)->create([
            'title' => 'Terms of Use',
            'slug'  => 'terms-of-use',
        ]);

        factory(App\Page::class)->create([
            'title' => 'Partnership Program',
            'slug'  => 'partnership-program',
        ]);

        factory(App\Page::class)->create([
            'title' => 'List Your Funeral Home',
            'slug'  => 'list-your-funeral-home',
        ]);

        factory(App\Page::class)->create([
            'title' => 'How We Help',
            'slug'  => 'how-we-help',
        ]);

        factory(App\Page::class)->create([
            'title' => 'Help',
            'slug'  => 'help',
        ]);

        factory(App\Page::class)->create([
            'title' => 'Checklist',
            'slug'  => 'checklist',
        ]);
    }
}
