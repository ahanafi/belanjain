<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

class MasterDataController extends Controller
{
    public function items()
    {
        $items = Item::latest()->get();

        return datatables()
            ->of($items)
            ->editColumn('image', function ($item) {
                $imageSource = Storage::exists($item->image) ? Storage::url($item->image) : asset('images/default-image.png');
                return "<img width='100px' src='$imageSource' alt='$item->name' class='img-thumbnail'>";
            })
            ->addColumn('action', function ($item) {
                return "
                    <a href='" . route('items.edit', $item->id) . "' class='btn btn-light'>
                        <i class='fa fa-pencil-alt'></i>
                    </a>
                    <a href='#' class='btn btn-danger'
                        onclick='confirmDelete(`items`, `" . $item->id . "`)'>
                        <i class='fa fa-trash'></i>
                    </a>";
            })
            ->rawColumns(['image', 'action'])
            ->toJson();
    }

    public function customers()
    {
        $customers = Customer::orderBy('name')->get();

        return datatables()
            ->of($customers)
            ->addColumn('action', function ($customer) {
                return "
                    <a href='#'
                       onclick='showFormCustomer(`" . $customer->id . "`, `" . $customer->name . "`, `" . $customer->phone . "`)'
                       class='btn btn-light'
                    >
                        <i class='fa fa-pencil-alt'></i>
                    </a>
                    <a href='#' class='btn btn-danger'
                        onclick='confirmDelete(`customers`, `" . $customer->id . "`)'>
                        <i class='fa fa-trash'></i>
                    </a>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function showCustomer(Customer $customer)
    {
        return response()->json([
            'status' => 'success',
            'data' => $customer
        ], 200);
    }

    public function transactions()
    {
        $transactions = Transaction::latest()->get();

        return datatables()
            ->of($transactions)
            ->addColumn('action', function ($transaction) {
                $inputOrderButton = "
                    <a href='".route('transactions.order.create', $transaction->id)."' class='btn btn-info'>
                        <i class='fa fa-shopping-cart'></i>
                        <span>INPUT ORDER</span>
                    </a>";

                $actionButton = "
                    <a href='#'
                        class='btn btn-light'
                        onclick='showFormTransaction(`" . $transaction->id . "`, `" . $transaction->number . "`, `" . $transaction->shopping_date . "`)'
                    >
                        <i class='fa fa-pencil-alt'></i>
                    </a>
                    <a href='#' class='btn btn-danger'
                        onclick='confirmDelete(`transactions`, `" . $transaction->id . "`)'>
                        <i class='fa fa-trash'></i>
                    </a>";

                if (!$transaction->isDone()) {
                    return $inputOrderButton . $actionButton;
                }

                return $actionButton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
