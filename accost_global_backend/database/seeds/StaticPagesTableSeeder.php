<?php

use Illuminate\Database\Seeder;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['name' => 'About Us', 'slug' => 'about-us' , 'page_title' => 'About Us'],
            ['name' => 'Contact Us', 'slug' => 'contact-us' , 'page_title' => 'Contact Us'],
            ['name' => 'Plans', 'slug' => 'plans' , 'page_title' => 'Plans'],
            ['name' => 'FAQs', 'slug' => 'faq' , 'page_title' => 'FAQs'],
            ['name' => 'Privacy Policy', 'slug' => 'privacy-policy' , 'page_title' => 'Privacy Policy'],
            ['name' => 'Terms & Conditions', 'slug' => 'terms-&-conditions' , 'page_title' => 'Terms & Conditions'],
            ['name' => 'How it works', 'slug' => 'how-it-works' , 'page_title' => 'How It Works']
        ];

        foreach ($values as $value) {
            \App\StaticPage::create($value);
        }
    }
}
