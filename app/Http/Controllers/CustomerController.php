<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function store(StoreCustomerRequest $request)
    {
        if(Customer::create($request->except('_token'))) {
            $message = setFlashMessage('success', 'create', 'pelanggan');
        } else {
            $message = setFlashMessage('error', 'create', 'pelanggan');
        }

        return redirect()->back()->with('message', $message);
    }

    public function show(Customer $customer)
    {
        //
    }

    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        if($customer->update($request->except('_token'))) {
            $message = setFlashMessage('success', 'update', 'pelanggan');
        } else {
            $message = setFlashMessage('error', 'update', 'pelanggan');
        }

        return redirect()->back()->with('message', $message);
    }

    public function destroy(Customer $customer)
    {
        if($customer->delete()) {
            $message = setFlashMessage('success', 'delete', 'pelanggan');
        } else {
            $message = setFlashMessage('error', 'delete', 'pelanggan');
        }

        return redirect()->back()->with('message', $message);
    }
}
