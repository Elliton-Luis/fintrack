<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Icon;

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

        Carbon::setLocale('pt_BR');

        $month = Carbon::now()->translatedFormat('F');

        $startOfMonth = Carbon::now()->startOfMonth();

        $endOfMonth = Carbon::now()->endOfMonth();

        $categories = Category::with('icon')->where('user_id',$this->id)->orWhereNull('user_id')->get();

        $recentTransactions = $this->getTransactions()->take(5)->with('category.icon')->get()->whereBetween('transaction_date', [$startOfMonth, $endOfMonth]);

        $icons = Icon::orderBy('name','asc')->select('id','name','class',)->get();

        $transactions = $this->getTransactions()->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])->select('id','title','type','amount','category_id')->with('category:id,name')->get();

        return Inertia::render('Dashboard', [
            'categories' => $categories,
            'transactions' => $transactions,
            'recentTransactions' => $recentTransactions,
            'icons' => $icons,
            'month'=>$month
        ]);
    }

    public function transactions(Request $request)
    {
        $query = $this->getTransactions()->with('category');

        $query->when($request->input('search'), function ($q, $search) {
            $q->where(function ($subQ) use ($search) {
                $subQ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });

        $query->when($request->input('type'), function ($q, $type) {
            $q->where('type', $type);
        });

        if ($request->input('sort') === 'amount') {
            $query->orderBy('amount', 'desc');
        } else {
            $query->orderBy('transaction_date', 'desc');
        }

        $transactions = $query->paginate(6)->withQueryString();

        return Inertia::render('Transaction', [
            'filters' => $request->only(['search', 'type', 'sort']),
            'transactions' => $transactions->through(function ($t) {
                return [
                    'id'          => $t->id,
                    'title'       => $t->title,
                    'description' => $t->description,
                    'amount'      => $t->amount,
                    'date'        => $t->transaction_date,
                    'type'        => $t->type,
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
