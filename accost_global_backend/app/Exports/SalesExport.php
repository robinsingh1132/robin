<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct(){
       /*$this->appendRows(array(
            'appended', 'appended'
        ));*/
    } 

    public function collection()
    {    
        $sales=  Order::where('status',1)->get();
        return $sales;
    }

    public function map($sales) : array {
        if($sales->status==1){
           $sales_status='Done';
        }
        $total_amount = $sales->total_amount;
        return [
            $sales->id,
            $sales->order_date,
            $sales->invoice_id,
            $sales->total_amount,
            $sales->shipped_date,
            $sales_status,
            $total_amount+$sales->total_amount
        ];
    }

    public function headings(): array
    {
        return [
            'Sales Id',
            'Sales Order Date',
            'Sales Invoice Id',
            'Total Amount',
            'Sales Shipped Date',
            'Sales Status',
            'total amount'
        ];
    }
}