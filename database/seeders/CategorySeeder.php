<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        Category::create([
            'name' => 'Salário',
            'type' => 'income',
            'icon_id' => 1,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Freelance',
            'type' => 'income',
            'icon_id' => 2,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Investimentos',
            'type' => 'income',
            'icon_id' => 3,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Rendimentos',
            'type' => 'income',
            'icon_id' => 4,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Reembolso',
            'type' => 'income',
            'icon_id' => 5,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Alimentação',
            'type' => 'expense',
            'icon_id' => 6,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Transporte',
            'type' => 'expense',
            'icon_id' => 7,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Lazer',
            'type' => 'expense',
            'icon_id' => 8,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Moradia',
            'type' => 'expense',
            'icon_id' => 9,
            'user_id' => 1,
        ]);

        Category::create([
            'name' => 'Educação',
            'type' => 'expense',
            'icon_id' => 10,
            'user_id' => 1,
        ]);

    }
}
