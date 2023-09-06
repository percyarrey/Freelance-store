<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed the categories table
        
        for ($i = 1; $i <= 5; $i++) {
            DB::table('categories')->insert([
                'category' => 'Category '.$i
            // Add more categories as needed
        ]);
        }

        // Seed the products table
        for ($i = 1; $i <= 12; $i++) {
            DB::table('products')->insert([
                'imgpath' => 'images/p' . $i . '.png',
                'name' => 'Men ' . $i,
                'category'=>rand(1, 5),
                'price' => rand(1, 100), // assuming price increases by 9.99 for each product
                'description' => 'This is the description for Product ' . $i,
                'quantity' => rand(1, 100), // random quantity between 1 and 100
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}