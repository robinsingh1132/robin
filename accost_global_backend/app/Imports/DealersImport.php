<?php

namespace App\Imports;
use App\Dealer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class DealersImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);

        /*$dealer = Dealer::create([
            'first_name' =>  $row['first_name'],
            'last_name'  =>  $row['last_name'],
            'contact_number'     =>  $row['contact_number'],
            'email'=> $row['email'],
            'address'=>$row['address'],
        ]); */  
        $dealer = [
            'first_name' =>  $row['first_name'],
            'last_name'  =>  $row['last_name'],
            'contact_number'     =>  $row['contact_number'],
            'email'=> $row['email'],
            'address'=>$row['address'],
        ];     
        return $dealer;
    }

    public function rules(): array
    {
       
        return [            
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'contact_number' => 'unique:Dealers,contact_number|required|numeric|min:10|max:15',
            'email' => 'unique:Dealers,email',            
            'address' => 'required'
        ];
    }
}
