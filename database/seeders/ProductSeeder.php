<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100 ; $i++) {
        Product::create([
            'user_id' => rand(1, 3),
            'title' => Str::random(10),
            'short_description' => Str::random(5),
            'description' => Str::random(15),
            'image' => 'product.jpg',
            'category_id' => rand(1, 5),
        ]);
        }
    }
}
