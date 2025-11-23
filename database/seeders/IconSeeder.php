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
            ['name' => 'Salário',         'class' => 'pi-wallet',            'type' => 'category'],
            ['name' => 'Freelance',       'class' => 'pi-briefcase',         'type' => 'category'],
            ['name' => 'Investimentos',   'class' => 'pi-chart-line',        'type' => 'category'],
            ['name' => 'Rendimentos',     'class' => 'pi-bitcoin',           'type' => 'category'], // usado bitcoin para “moeda / rendimento”
            ['name' => 'Reembolso',       'class' => 'pi-refresh',            'type' => 'category'],
            ['name' => 'Vendas',          'class' => 'pi-tag',                'type' => 'category'],
            ['name' => 'Prêmios/Bônus',   'class' => 'pi-trophy',             'type' => 'category'],
            ['name' => 'Renda Extra',     'class' => 'pi-plus-circle',        'type' => 'category'],

            ['name' => 'Alimentação',     'class' => 'pi-shopping-cart',      'type' => 'category'],
            ['name' => 'Moradia',         'class' => 'pi-home',                'type' => 'category'],
            ['name' => 'Transporte',      'class' => 'pi-car',                 'type' => 'category'],
            ['name' => 'Contas (Luz/Água)','class' => 'pi-bolt',               'type' => 'category'],
            ['name' => 'Internet/Wi-Fi',  'class' => 'pi-wifi',                'type' => 'category'],
            ['name' => 'Telefone/Celular','class' => 'pi-phone',               'type' => 'category'],
            ['name' => 'Saúde/Médico',    'class' => 'pi-heart',               'type' => 'category'],
            ['name' => 'Farmácia',        'class' => 'pi-band-aid',            'type' => 'category'], // não encontrei, vou comentar depois

            ['name' => 'Lazer',           'class' => 'pi-star',                'type' => 'category'],
            ['name' => 'Restaurantes/iFood','class' => 'pi-ticket',            'type' => 'category'],
            ['name' => 'Compras Gerais',  'class' => 'pi-shopping-bag',       'type' => 'category'],
            ['name' => 'Roupas/Vestuário','class' => 'pi-tags',                'type' => 'category'],
            ['name' => 'Eletrônicos/Tech','class' => 'pi-desktop',             'type' => 'category'],
            ['name' => 'Streaming/TV',    'class' => 'pi-video',               'type' => 'category'],
            ['name' => 'Viagens',         'class' => 'pi-compass',             'type' => 'category'],
            ['name' => 'Cuidados Pessoais','class' => 'pi-user',                'type' => 'category'],

            ['name' => 'Educação',        'class' => 'pi-book',                'type' => 'category'],
            ['name' => 'Família/Filhos',  'class' => 'pi-users',               'type' => 'category'],
            ['name' => 'Pets',            'class' => 'pi-github',              'type' => 'category'], // “github” pode não fazer muito sentido, mas existe

            ['name' => 'Bancos/Taxas',    'class' => 'pi-building-columns',   'type' => 'category'],
            ['name' => 'Cartão de Crédito','class' => 'pi-credit-card',        'type' => 'category'],
            ['name' => 'Seguros',         'class' => 'pi-shield',              'type' => 'category'],
            ['name' => 'Impostos',        'class' => 'pi-percentage',          'type' => 'category'],
            ['name' => 'Dívidas/Empréstimos','class' => 'pi-money-bill',      'type' => 'category'],
            ['name' => 'Poupança/Reserva','class' => 'pi-lock',                 'type' => 'category'],

            ['name' => 'Presentes/Doações','class' => 'pi-gift',                'type' => 'category'],
            ['name' => 'Manutenção/Reparos','class' => 'pi-wrench',             'type' => 'category'],
            ['name' => 'Serviços Online', 'class' => 'pi-cloud',                'type' => 'category'],
            ['name' => 'Outros',          'class' => 'pi-box',                  'type' => 'category'],
            ['name' => 'Desconhecido',    'class' => 'pi-question-circle',     'type' => 'category'],
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
