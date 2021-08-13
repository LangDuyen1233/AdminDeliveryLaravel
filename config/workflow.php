<?php
//1=New: Trạng thái mặc định của đơn hàng, đơn hàng vừa được thêm
//2=Prepares: Người bán đang chuẩn bị đơn hàng
//3=Delivering: Đang giao hàng
//4=Delivered: Đã giao hàng
//5=Cancel: Đã hủy
//6=Waiting: Đang chờ

return [
    //name workflow for status order
    'application' => [
        'type' => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'property' => 'order_status_id'
        ],
        'supports' => ['App\Models\Order'],
        'places' => ['1', '2', '3', '4', '5','6'],
        'transitions' => [
            'PREPARES' => [
                'from' => '1',
                'to' => '2',
            ],
            'DELIVERING' => [
                'from' => ['2'],
                'to' => '3',
            ],
            'DELIVERED' => [
                'from' => ['3'],
                'to' => '4',
            ],
            'CANCEL' => [
                'from' => '1',
                'to' => '5',
            ],
            'WAITING' => [
                'from' => '2',
                'to' => '6',
            ],
            'RECEIVED' => [
                'from' => '6',
                'to' => '3',
            ],
        ],
    ],
];
