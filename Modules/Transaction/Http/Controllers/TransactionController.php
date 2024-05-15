<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Services\TransactionManager;
use Modules\User\Entities\User;

class TransactionController extends Controller
{
    protected $transactionManager;

    public function __construct(TransactionManager $transactionManager)
    {
        $this->transactionManager = $transactionManager;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable'],
            'type' => ['nullable'],
            'status' => ['nullable'],
        ]);

        $query = Transaction::query();
        if (@$filters['search']) {
            $search = $filters['search'];
            $query->where(function($query) use ($search) {
                $query
                ->whereRaw('LOWER(from_address) LIKE ? ',['%'.trim(strtolower($search)).'%'])
                ->orwhereRaw('LOWER(to_address) LIKE ? ',['%'.trim(strtolower($search)).'%'])
                ->orWhereHas('user', function ($q) use ($search){
                    $q->whereRaw('LOWER(username) LIKE ? ',['%'.trim(strtolower($search)).'%']);
                });
            });
        }
        if (@$filters['type'] && $filters['type'] != 'all') {
            if ($filters['type'] != 'all')
            $query->where('type', $filters['type']);
        }
        if (@$filters['status'] && $filters['status'] != 'all') {
            if ($filters['status'] != 'all')
            $query->where('status', $filters['status']);
        }

        $count = $query->count();
        $transactions = $query->latest()->paginate(10);
        return view('transaction::index', compact('transactions', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $types = Transaction::defaultTypes();
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('transaction::create', compact('types', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->transactionManager->create($request->all());
        if(auth()->user()->isRoleAdmin()){
            return redirect()->route('transactions.')->with([
                'success' => 'Transaction successfully created!',
            ]);
        } else {
            return redirect()->route('notifications')->with([
                'success' => 'Transaction successfully created!',
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Transaction $transaction)
    {
        return view('transaction::show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Transaction $transaction)
    {
        $types = Transaction::defaultTypes();
        $statuses = Transaction::defaultStatus();
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('transaction::edit', compact('transaction', 'statuses', 'types', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->transactionManager->update($transaction, $request->all());
        $previous = $request->get('previous') ?? url()->route('transactions.');
        return redirect($previous)->with([
            'success' => 'Transaction successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $transaction->delete();
        $previous = $request->get('previous') ?? url()->route('transactions.');
        return redirect($previous)->with([
            'danger' => 'Transaction successfully deleted!',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = $request->validate([
            'transaction_id' => ['required', 'exists:transactions,id'],
            'status' => ['required', Rule::in(Transaction::defaultStatus())],
        ]);
        $transaction = Transaction::find($data['transaction_id']);
        $transaction->status = $data['status'];
        $transaction->save();

        return redirect()->back()->with('success', 'Status Changed!');
    }
}
