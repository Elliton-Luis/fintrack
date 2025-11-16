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
    }
}
