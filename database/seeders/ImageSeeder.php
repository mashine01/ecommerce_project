<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Generate and insert random image URLs for each product
    public function run()
    {
        $faker = Faker::create();

        // Retrieve pre-existing products
        $products = Product::all();

        // Update each product with random image URLs
        foreach ($products as $product) {
            $product->update([
                'front_image' => $faker->imageUrl(),
                'back_image' => $faker->imageUrl(),
                'left_image' => $faker->imageUrl(),
                'right_image' => $faker->imageUrl(),
            ]);
        }
    }
}
