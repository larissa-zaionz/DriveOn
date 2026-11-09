<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Capacetes Fechados', 'slug' => 'capacetes-fechados'],
            ['name' => 'Capacetes Escamoteáveis', 'slug' => 'capacetes-escamoteaveis'],
            ['name' => 'Capacetes Abertos', 'slug' => 'capacetes-abertos'],
            ['name' => 'Viseiras e Acessórios', 'slug' => 'viseiras-e-acessorios'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}