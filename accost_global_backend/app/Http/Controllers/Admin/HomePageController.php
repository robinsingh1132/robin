<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function productList()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $superCategories = ProductSuperCategory::all();
        $categories = ProductCategory::all();
        $subCategories = ProductSubcategory::all();
        return view('admin.Product.list',compact('superCategories','categories','subCategories'));
    }
}
