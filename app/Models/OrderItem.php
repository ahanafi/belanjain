<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'qty', 'price'];

    /*
     * RELATION
     * */
    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
