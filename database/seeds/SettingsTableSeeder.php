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
        \App\Setting::create([
            'site_name' => 'Laravel Blog',
            'contact_number' => '91 9562 6874 63',
            'contact_email' => 'info@laravel_blog.com',
            'address' => 'Russia, Petersburg'
        ]);
    }
}
