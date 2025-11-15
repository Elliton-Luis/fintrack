<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'type'        => 'required|in:gain,expense',
        'value'       => 'required|numeric|min:0',
        'isRecurring' => 'required|boolean',
        ]);

        Transaction::create([
            ...$validated,
            'category'=> 1,
            'user_id'=>1
        ]);

        return redirect()->back()->with('success');

    }
}
