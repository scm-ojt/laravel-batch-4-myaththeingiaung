<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Factory::create();

        $admin           = new Admin();
        $admin->name     = 'Admin';
        $admin->email    = 'admin@gmail.com';
        $admin->phone    = '09 123123123';
        $admin->address  = 'Yangon';
        $admin->password = Hash::make('admin');
        $admin->save();
    }
}
