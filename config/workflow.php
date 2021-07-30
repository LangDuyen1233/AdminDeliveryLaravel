<?php
//New: Trạng thái mặc định của đơn hàng, đơn hàng vừa được thêm
//Prepares: Người bán đang chuẩn bị đơn hàng
//Delivering: Đang giao hàng
//Delivered: Đã giao hàng
//Cancel: Đã hủy

return [
    //name workflow for status order
    'application' => [
        'type' => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'property' => 'status'
        ],
        'supports' => ['App\Models\Order'],
        'places' => ['NEW', 'PREPARES', 'DELIVERING', 'DELIVERED', 'CANCEL'],
        'transitions' => [
            'PREPARES' => [
                'from' => 'NEW',
                'to' => 'PREPARES',
            ],
            'DELIVERING' => [
                'from' => ['PREPARES', 'NEW'],
                'to' => 'DELIVERING',
            ],
            'DELIVERED' => [
                'from' => ['DELIVERING', 'PREPARES'],
                'to' => 'DELIVERED',
            ],
            'CANCEL' => [
                'from' => 'NEW',
                'to' => 'CANCEL',
            ],
        ],
    ],
];
