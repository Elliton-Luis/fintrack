<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Transaction;
use App\Models\Category;

class TransactionController extends Controller
{

    public function dashboard()
    {
        $categories = Category::select('id', 'name')->get();
        $recentTransactions = Transaction::latest()->take(5)->with('category.icon')->get();
        $transactions = Transaction::with('category')->get();

        return Inertia::render('Dashboard', [
            'categories' => $categories,
            'transactions' => $transactions,
            'recentTransactions' => $recentTransactions,
            'flash' => session('success')
        ]);
    }

    public function transactions(){
        return Inertia::render('Transaction');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:income,expense',
            'amount'       => 'required|numeric|min:0',
            'isRecurring' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'transaction_date' => 'nullable|date'
        ]);

        Transaction::create([
            ...$validated,
            'user_id' => 1,
        ]);

        return redirect()->route('dashboard')->with('success','Transição Realizada com Sucesso');
    }

}
