<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Salário',
            'description' => 'Pagamento referente ao mês de novembro',
            'amount' => 5000.00,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-11-15',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 6,
            'title' => 'Supermercado',
            'description' => null,
            'amount' => 350.75,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-14',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 2,
            'title' => 'Freelancer',
            'description' => 'Projeto extra entregue no início do mês',
            'amount' => 1200.00,
            'type' => 'income',
            'isRecurring' => false,
            'transaction_date' => '2025-11-10',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 7,
            'title' => 'Combustível',
            'description' => null,
            'amount' => 200.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-11-13',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 8,
            'title' => 'Cinema',
            'description' => 'Sessão noturna com amigos',
            'amount' => 75.50,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-12',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 3,
            'title' => 'Rendimento de investimentos',
            'description' => 'Lucro mensal da aplicação',
            'amount' => 800.00,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-11-05',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 4,
            'title' => 'Rendimentos bancários',
            'description' => 'Juros sobre poupança',
            'amount' => 120.00,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-11-06',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 6,
            'title' => 'Padaria',
            'description' => 'Pães e lanches',
            'amount' => 45.30,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-07',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 6,
            'title' => 'Restaurante',
            'description' => 'Almoço de trabalho',
            'amount' => 60.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-08',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 7,
            'title' => 'Uber',
            'description' => 'Corrida diária',
            'amount' => 150.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-11-09',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 9,
            'title' => 'Aluguel',
            'description' => 'Mensalidade do apartamento',
            'amount' => 1800.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-11-01',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 10,
            'title' => 'Curso online',
            'description' => 'Curso de desenvolvimento',
            'amount' => 200.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-11',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 8,
            'title' => 'Show',
            'description' => 'Ingresso para show local',
            'amount' => 250.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-11-16',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 5,
            'title' => 'Reembolso viagem',
            'description' => 'Dinheiro devolvido de despesas da viagem',
            'amount' => 300.00,
            'type' => 'income',
            'isRecurring' => false,
            'transaction_date' => '2025-11-17',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 2,
            'title' => 'Projeto extra',
            'description' => 'Serviço pontual de freelancer',
            'amount' => 500.00,
            'type' => 'income',
            'isRecurring' => false,
            'transaction_date' => '2025-11-18',
        ]);
    }
}
