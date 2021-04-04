<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItems;

class OrderItemsController extends Controller
{
    public function insertOrderItems($orderItems)
    {
        OrderItems::insert($orderItems);
    }

    public function getOrderItemsArray($transaction_id)
    {
        return OrderItems::where('order_id', $transaction_id)->get()->toArray();
    }
}
