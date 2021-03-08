<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TopSellProductExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {    
        $products =  Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->orderBy('top_selling_count','desc')->get();
        return $products;
    }

    public function map($products) : array {
        return [
            $products->name,
            $products->subCategories->subcategories->name,
            $products->sku,
            $products->status
        ] ;

    }

    public function headings(): array
    {
        return [
            'Name',
            'Subcategory',
            'Sku',
            'Status'
        ];
    }
}