<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Str;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

    foreach ($categories as $category) {
        for ($i = 1; $i <= 10; $i++) {
            $task_title = '';

            // カテゴリーごとにタスクタイトルを設定
            switch ($category->name) {
                case 'Railsコース':
                    $task_title = "Rails Task {$i}";
                    break;
                case 'Dockerコース':
                    $task_title = "Docker Task {$i}";
                    break;
                case 'JavaScriptコース':
                    $task_title = "JavaScript Task {$i}";
                    break;
                case 'Next.jsコース':
                    $task_title = "Next.js Task {$i}";
                    break;
            }

            Task::create([
                'title' => $task_title,
                'description' => "This is a description for {$task_title}",
                'category_id' => $category->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    }
}
