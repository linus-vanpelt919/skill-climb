<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Railsコース',
            'Dockerコース',
            'JavaScriptコース',
            'Next.jsコース',
        ];

        foreach ($categories as $category_name) {
            Category::create([
                'name' => $category_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
