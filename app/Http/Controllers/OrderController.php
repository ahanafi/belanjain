<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Transaction $transaction)
    {
        $customers = Customer::orderBy('name')->get();
        $items = Item::orderBy('name')->get();
        $transaction->load(['orders']);

        return view('transactions.input-order', compact('transaction', 'customers', 'items'));
    }

    public function store(StoreOrderRequest $request, Transaction $transaction)
    {
        $customerId = $request->get('customer_id');
        $order = $transaction->orders()->create(['customer_id' => $customerId]);

        $items = $request->get('items');
        $qty  = $request->get('qty');
        $price = $request->get('price');

        for ($i=0, $iMax = count($items); $i < $iMax; $i++ ){
            $order->orderItems()->create([
                'item_id' => $items[$i],
                'price' => $price[$i],
                'qty' => $qty[$i]
            ]);
        }

        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'Data order berhasil disimpan.',
        ]);
    }

    public function destroy(Order $order)
    {
        if($order->delete()) {
            $message = setFlashMessage('success', 'delete', 'order');
        } else {
            $message = setFlashMessage('error', 'delete', 'order');
        }

        return redirect()->back()->with('message', $message);
    }
}
