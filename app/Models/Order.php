<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'customer_id'];

    /*
     * RELATION
     * */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class)
            ->with('item');
    }
}
