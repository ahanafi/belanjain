<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(StoreItemRequest $request)
    {
        if (Item::create($request->validated())) {
            $message = setFlashMessage('success', 'insert', 'barang');
        } else {
            $message = setFlashMessage('error', 'insert', 'barang');
        }

        return redirect()->route('items.index')->with('message', $message);
    }

    public function edit(Item $item)
    {
        return view('items.update', compact('item'));
    }

    public function update(StoreItemRequest $request, Item $item)
    {
        if ($item->update($request->validated())) {
            $message = setFlashMessage('success', 'update', 'barang');
        } else {
            $message = setFlashMessage('error', 'update', 'barang');
        }

        return redirect()->route('items.index')->with('message', $message);
    }

    public function destroy(Item $item)
    {
        if ($item->delete()) {
            $message = setFlashMessage('success', 'delete', 'barang');
        } else {
            $message = setFlashMessage('error', 'delete', 'barang');
        }

        return redirect()->route('items.index')->with('message', $message);
    }
}
