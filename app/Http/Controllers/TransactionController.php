<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Transaction;
use App\Models\Category;

use Carbon\Carbon;

use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public $id;

    public function __construct()
    {
        $this->id = auth()->id();
    }

    public function dashboard()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $categories = Category::where('user_id',$this->id)->orWhereNull('user_id')->get();

        $recentTransactions = $this->getTransactions()->take(4)->with('category.icon')->get();

        $transactions = $this->getTransactions()->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])->get();

        return Inertia::render('Dashboard', [
            'categories' => $categories,
            'transactions' => $transactions,
            'recentTransactions' => $recentTransactions,
            'flash' => session('success')
        ]);
    }

    public function transactions()
    {
        $transactions = $this->getTransactions()->with('category')->paginate(6);

        return Inertia::render('Transaction', [
            'transactions' => $transactions->through(function ($t) {
                return [
                    'id'            => $t->id,
                    'title'         => $t->title,
                    'description'   => $t->description,
                    'amount'        => $t->amount,
                    'date'          => $t->transaction_date,
                    'type'          => $t->type,
                    'category' => [
                        'name' => $t->category->name ?? 'Desconhecida',
                        'icon' => $t->category->icon ?? 'pi pi-question-circle'
                    ]
                ];
            })
        ]);
    }

    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();

        Transaction::create([
            ...$validated,
            'user_id' => $this->id,
        ]);

        return redirect()->route('dashboard')->with('success','Transação Realizada com Sucesso');
    }

    private function getTransactions(){
        return Transaction::where('user_id',$this->id)->latest();
    }
}
