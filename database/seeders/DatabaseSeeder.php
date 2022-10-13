<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Str;
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

        // Category
        // $categories = Category::factory()->count(10)->create();
        $category = new Category();
        $category->name = 'Dell';
        $category->save();

        $category = new Category();
        $category->name = 'Oppo';
        $category->save();

        $category = new Category();
        $category->name = 'Watch';
        $category->save();

        $category = new Category();
        $category->name = 'Mouse';
        $category->save();

        $category = new Category();
        $category->name = 'Adapter';
        $category->save();

        $category = new Category();
        $category->name = 'Samsung';
        $category->save();

        $category = new Category();
        $category->name = 'Fruits';
        $category->save();

        $category = new Category();
        $category->name = 'Bag';
        $category->save();

        $category = new Category();
        $category->name = 'MI';
        $category->save();

        $category = new Category();
        $category->name = 'Vivo';
        $category->save();

        $category = new Category();
        $category->name = 'Acer';
        $category->save();

        $category = new Category();
        $category->name = 'Asus';
        $category->save();

        //User
        $users = User::factory()->count(5)->create();

    }
}
