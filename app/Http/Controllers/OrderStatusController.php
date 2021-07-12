<?php


namespace App\Http\Controllers;


use App\Models\OrderStatus;

class OrderStatusController extends Controller
{
    public function index()
    {
        $orderStatus = OrderStatus::all();
//        dd($order);
        return view('statusOrder.index',
            [
                'orderStatus' => $orderStatus,
            ]
        );
    }

}
