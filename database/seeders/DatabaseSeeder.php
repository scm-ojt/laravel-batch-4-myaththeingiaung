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
        // $user = new User();
        // $user->name = 'Mg Mg';
        // $user->email ='mgmg@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Pyay';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);

        // $user = new User();
        // $user->name = 'Mya Mya';
        // $user->email ='myamya@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Pyay';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);

        // $user = new User();
        // $user->name = 'Aung Aung';
        // $user->email ='aungaung@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Yangon';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);

        // $user = new User();
        // $user->name = 'Aye Aye';
        // $user->email ='ayeaye@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Yangon';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);

        // $user = new User();
        // $user->name = 'Thae Thae';
        // $user->email ='thaethae@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Mandalay';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);
        
        // $user = new User();
        // $user->name = 'Ko Ko';
        // $user->email ='koko@gmail.com';
        // $user->phone = '09987654321';
        // $user->address = 'Mandalay';
        // $user->password = Hash::make('12345');
        // $user->remember_token = Str::random(10);

    }
}
