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
            'title' => 'Salário Mensal',
            'description' => 'Pagamento referente a Dezembro',
            'amount' => 5500.00,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-12-05',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 2,
            'title' => 'Desenvolvimento Web',
            'description' => 'Criação de Landing Page',
            'amount' => 1200.00,
            'type' => 'income',
            'isRecurring' => false,
            'transaction_date' => '2025-12-10',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 3,
            'title' => 'Dividendos FIIs',
            'description' => 'Proventos mensais',
            'amount' => 320.50,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-12-15',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 4,
            'title' => 'Juros Poupança',
            'description' => 'Rendimento automático',
            'amount' => 45.90,
            'type' => 'income',
            'isRecurring' => true,
            'transaction_date' => '2025-12-01',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 5,
            'title' => 'Reembolso Uber',
            'description' => 'Reembolso de transporte corporativo',
            'amount' => 85.00,
            'type' => 'income',
            'isRecurring' => false,
            'transaction_date' => '2025-12-08',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 6,
            'title' => 'Almoço Restaurante',
            'description' => 'Rodízio com amigos',
            'amount' => 89.90,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-12-06',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 7,
            'title' => 'Combustível',
            'description' => 'Tanque cheio gasolina',
            'amount' => 250.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-12-07',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 8,
            'title' => 'Ingressos Cinema',
            'description' => 'Estreia de filme',
            'amount' => 60.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-12-12',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 9,
            'title' => 'Aluguel',
            'description' => 'Mensalidade apartamento',
            'amount' => 1800.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-12-05',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 10,
            'title' => 'Curso Inglês',
            'description' => 'Mensalidade escola de idiomas',
            'amount' => 350.00,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-12-10',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 11,
            'title' => 'Consulta Médica',
            'description' => 'Dermatologista particular',
            'amount' => 400.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-12-14',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 12,
            'title' => 'Compras Semanais',
            'description' => 'Mantimentos para casa',
            'amount' => 650.45,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-12-02',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 13,
            'title' => 'Conta de Luz',
            'description' => 'Referente a Novembro',
            'amount' => 185.30,
            'type' => 'expense',
            'isRecurring' => true,
            'transaction_date' => '2025-12-09',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 14,
            'title' => 'Presente Aniversário',
            'description' => 'Presente para familiar',
            'amount' => 150.00,
            'type' => 'expense',
            'isRecurring' => false,
            'transaction_date' => '2025-12-20',
        ]);
    }
}
