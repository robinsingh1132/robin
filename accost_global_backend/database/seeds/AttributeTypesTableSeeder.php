<?php

use Illuminate\Database\Seeder;

class AttributeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['type' => 'Text Field'],
            ['type' => 'Text Area'],
            ['type' => 'Date'],
            ['type' => 'Yes/No'],
            ['type' => 'Price'],
        ];

        foreach ($values as $value) {
            \App\AttributeType::create($value);
        }
    }
}
