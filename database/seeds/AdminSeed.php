<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;
use App\Model\Configuration;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'full_name' => 'Jules SONGE',
            'email' => 'songejules@gmail.com',
            'phone_number' => '0705767731',
            'country' => 'DR Congo',
            'city' => 'Goma',
            'password' => bcrypt('jules123'),
        ]);

        Admin::create([
            'full_name' => 'Christian Scott',
            'email' => 'irchristianscott@gmail.com',
            'phone_number' => '0756891594',
            'country' => 'Uganda',
            'city' => 'Kampala',
            'password' => bcrypt('chriscons'),
        ]);

        Configuration::create();
    }
}
