<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            ['name' => 'Salário',      'type' => 'income',  'icon_id' => 1],
            ['name' => 'Freelance',    'type' => 'income',  'icon_id' => 2],
            ['name' => 'Investimentos','type' => 'income',  'icon_id' => 3],
            ['name' => 'Rendimentos',  'type' => 'income',  'icon_id' => 4],
            ['name' => 'Reembolso',    'type' => 'income',  'icon_id' => 5],

            ['name' => 'Alimentação',  'type' => 'expense', 'icon_id' => 8],
            ['name' => 'Transporte',   'type' => 'expense', 'icon_id' => 10],
            ['name' => 'Lazer',        'type' => 'expense', 'icon_id' => 16],
            ['name' => 'Moradia',      'type' => 'expense', 'icon_id' => 9],
            ['name' => 'Educação',     'type' => 'expense', 'icon_id' => 24],
            ['name' => 'Saúde',        'type' => 'expense', 'icon_id' => 14],
            ['name' => 'Mercado',      'type' => 'expense', 'icon_id' => 18],
            ['name' => 'Contas Fixas', 'type' => 'expense', 'icon_id' => 11],
            ['name' => 'Outros',       'type' => 'expense', 'icon_id' => 36],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

    }
}
