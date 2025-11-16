<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Icon;

class IconSeeder extends Seeder
{

    public function run(): void
    {
        Icon::create([
            'name' => 'Salário',
            'class' => 'pi-wallet',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Freelance',
            'class' => 'pi-briefcase',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Investimentos',
            'class' => 'pi-chart-line',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Rendimentos',
            'class' => 'pi-coins',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Reembolso',
            'class' => 'pi-refresh',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Alimentação',
            'class' => 'pi-shopping-cart',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Transporte',
            'class' => 'pi-car',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Lazer',
            'class' => 'pi-star',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Moradia',
            'class' => 'pi-home',
            'type' => 'category',
        ]);

        Icon::create([
            'name' => 'Educação',
            'class' => 'pi-book',
            'type' => 'category',
        ]);
    }
}
