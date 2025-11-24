<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Icon;

class IconSeeder extends Seeder
{

    public function run(): void
    {
        $icons = [
            ['name' => 'Salário',           'class' => 'pi pi-wallet',              'type' => 'category'],
            ['name' => 'Freelance',         'class' => 'pi pi-briefcase',           'type' => 'category'],
            ['name' => 'Investimentos',     'class' => 'pi pi-chart-line',          'type' => 'category'],
            ['name' => 'Rendimentos',       'class' => 'pi pi-bitcoin',             'type' => 'category'],
            ['name' => 'Reembolso',         'class' => 'pi pi-refresh',             'type' => 'category'],
            ['name' => 'Vendas',            'class' => 'pi pi-tag',                 'type' => 'category'],
            ['name' => 'Prêmios/Bônus',     'class' => 'pi pi-trophy',              'type' => 'category'],

            ['name' => 'Alimentação',       'class' => 'pi pi-shopping-cart',       'type' => 'category'],
            ['name' => 'Moradia',           'class' => 'pi pi-home',                'type' => 'category'],
            ['name' => 'Transporte',        'class' => 'pi pi-car',                 'type' => 'category'],
            ['name' => 'Contas (Luz/Água)', 'class' => 'pi pi-bolt',                'type' => 'category'],
            ['name' => 'Internet/Wi-Fi',    'class' => 'pi pi-wifi',                'type' => 'category'],
            ['name' => 'Telefone/Celular',  'class' => 'pi pi-phone',               'type' => 'category'],
            ['name' => 'Saúde/Médico',      'class' => 'bi bi-heart-pulse',    'type' => 'category'],
            ['name' => 'Farmácia',          'class' => 'bi bi-capsule',             'type' => 'category'],

            ['name' => 'Lazer',             'class' => 'pi pi-star',                'type' => 'category'],
            ['name' => 'Restaurantes/iFood','class' => 'pi pi-ticket',              'type' => 'category'],
            ['name' => 'Compras Gerais',    'class' => 'pi pi-shopping-bag',        'type' => 'category'],
            ['name' => 'Roupas/Vestuário',  'class' => 'pi pi-tags',                'type' => 'category'],
            ['name' => 'Eletrônicos/Tech',  'class' => 'pi pi-desktop',             'type' => 'category'],
            ['name' => 'Streaming/TV',      'class' => 'pi pi-video',               'type' => 'category'],
            ['name' => 'Viagens',           'class' => 'pi pi-compass',             'type' => 'category'],
            ['name' => 'Cuidados Pessoais', 'class' => 'pi pi-user',                'type' => 'category'],

            ['name' => 'Educação',          'class' => 'pi pi-book',                'type' => 'category'],
            ['name' => 'Família/Filhos',    'class' => 'pi pi-users',               'type' => 'category'],
            ['name' => 'Pets',              'class' => 'bi bi-gitlab',                 'type' => 'category'],

            ['name' => 'Bancos/Taxas',      'class' => 'pi pi-building-columns',    'type' => 'category'],
            ['name' => 'Cartão de Crédito', 'class' => 'pi pi-credit-card',         'type' => 'category'],
            ['name' => 'Seguros',           'class' => 'pi pi-shield',              'type' => 'category'],
            ['name' => 'Impostos',          'class' => 'pi pi-percentage',          'type' => 'category'],
            ['name' => 'Dívidas/Empréstimos','class'=> 'pi pi-money-bill',          'type' => 'category'],
            ['name' => 'Poupança/Reserva',  'class' => 'pi pi-lock',                'type' => 'category'],

            ['name' => 'Presentes/Doações', 'class' => 'pi pi-gift',                'type' => 'category'],
            ['name' => 'Manutenção/Reparos','class' => 'pi pi-wrench',              'type' => 'category'],
            ['name' => 'Serviços Online',   'class' => 'pi pi-cloud',               'type' => 'category'],
            ['name' => 'Outros',            'class' => 'pi pi-box',                 'type' => 'category'],
            ['name' => 'Desconhecido',      'class' => 'pi pi-question-circle',     'type' => 'category'],
        ];

        foreach ($icons as $iconData) {
            Icon::firstOrCreate(
                ['class' => $iconData['class']],
                [
                    'name' => $iconData['name'],
                    'type' => $iconData['type']
                ]
            );
        }
    }
}
