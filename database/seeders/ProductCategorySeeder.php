<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'tagline' => 'Latest gadgets and devices',
                'description' => 'Find the latest electronics including smartphones, laptops, and more.',
                'image' => 'images/electronics.jpg',
                'children' => [
                    [
                        'name' => 'Mobile Phones',
                        'tagline' => 'Smartphones and accessories',
                        'description' => 'Explore a wide range of mobile phones and accessories.',
                        // 'image' => 'images/mobile_phones.jpg',
                    ],
                    [
                        'name' => 'Laptops',
                        'tagline' => 'High-performance laptops',
                        'description' => 'Discover laptops for work, gaming, and everyday use.',
                        // 'image' => 'images/laptops.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Fashion',
                'tagline' => 'Trendy clothing and accessories',
                'description' => 'Stay stylish with the latest fashion trends and accessories.',
                'image' => 'images/fashion.jpg',
                'children' => [
                    [
                        'name' => "Men's Clothing",
                        'tagline' => 'Stylish apparel for men',
                        'description' => 'Discover stylish clothing and apparel for men.',
                        // 'image' => 'images/mens_clothing.jpg',
                    ],
                ],
            ],
        ];
    }
}