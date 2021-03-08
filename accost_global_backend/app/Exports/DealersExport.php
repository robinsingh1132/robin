<?php

namespace App\Exports;

use App\Dealer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DealersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    
        $users =  Dealer::all();

        return $users;
    }

    public function map($users) : array {
        return [
            $users->first_name,
            $users->last_name,
            $users->email,
            $users->contact_number,
            $users->address
        ] ;

    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Contact Number',
            'Address'
        ];
    }
}
