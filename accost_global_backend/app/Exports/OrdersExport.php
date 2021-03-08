<?php

namespace App\Exports;

use App\Order;
use App\OrderDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {    
        $orders =  Order::all();
        return $orders;
    }

    public function map($orders) : array {
        return [
            $orders->id,
            $orders->order_date,
            $orders->invoice_id,
            $orders->total_amount,
            $orders->shipped_date,
            $orders->status
        ] ;

    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Order Date',
            'Invoice Id',
            'Total Amount',
            'Shipped Date',
            'status'
        ];
    }
}
