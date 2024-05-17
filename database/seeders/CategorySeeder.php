<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'categoryName'=> 'Men',
                'slug' => 'men',
                'icon'=>'demo/product/categories/baby.png'
            ],

            [
                'categoryName'=> 'Women',
                'slug' => 'wommen',
                'icon'=> 'demo/product/categories/beauty.png'
            ]
            ];

            foreach ($categories as $category){
                Category::create($category);
            }
    
        }
}
