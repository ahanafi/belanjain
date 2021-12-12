<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $number = Transaction::generateNumber();
        return view('transactions.index', compact('number'));
    }

    public function store(StoreTransactionRequest $request)
    {
        if(Transaction::create($request->except('_token'))) {
            $message = setFlashMessage('success', 'create', 'transaksi');
        } else {
            $message = setFlashMessage('error', 'create', 'transaksi');
        }

        return redirect()->back()->with('message', $message);
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function update(StoreTransactionRequest $request, Transaction $transaction)
    {
        if($transaction->update($request->except('_token'))) {
            $message = setFlashMessage('success', 'update', 'transaksi');
        } else {
            $message = setFlashMessage('error', 'update', 'transaksi');
        }

        return redirect()->back()->with('message', $message);
    }

    public function destroy(Transaction $transaction)
    {
        if($transaction->delete()) {
            $message = setFlashMessage('success', 'delete', 'transaksi');
        } else {
            $message = setFlashMessage('error', 'delete', 'transaksi');
        }

        return redirect()->back()->with('message', $message);
    }
}
