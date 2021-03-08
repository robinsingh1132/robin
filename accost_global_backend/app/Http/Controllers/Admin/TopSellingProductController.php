<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\TopSellProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Product;
use App\ProductSuperCategory;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductCategorySubCategory;

class TopSellingProductController extends Controller
{
    public function listTopSellingProduct()
	{
		$this->setNavigation(['menu-item-topSellingProduct']);
		$superCategories = ProductSuperCategory::all();
        $categories = ProductCategory::all();
        $subCategories = ProductSubcategory::all();
        return view('admin.TopSellingProduct.list',compact('superCategories','categories','subCategories'));
	}
    /*public function TopSellProductData()
    {        
    	$this->setNavigation(['menu-item-topSellingProduct']);
    	$data=Product::where([['status',1],['top_selling_count','>','0']])->orderBy('top_selling_count','desc')->get();
    	return datatables()->Collection($data)
        ->addColumn('action', function ($modal) {
            return '
            <a href="'.route('delete-sales',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this sales details?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
            '; })
        ->addColumn('order_details', function ($modal) { 
            return '<a href="'.route('sales-items-details',$modal->id).'" data-toggle="tooltip" title="Items details"><i class="fas fa-shopping-bag"></i></a>&nbsp
            <a href="'.route('sales-address-details',$modal->id).'" data-toggle="tooltip" title="User address details"><i class="fas fa-address-card"></i></a>&nbsp
            <a href="'.route('sales-shipping-details',$modal->id).'" data-toggle="tooltip" title="Shipping details"><i class="fas fa-shipping-fast"></i></a>&nbsp
            <a href="'.route('sales-payment-details',$modal->id).'" data-toggle="tooltip" title="Payment details"><i class="fab fa-cc-mastercard"></i></a>
              '; })      
        ->addIndexColumn()
        ->toJson();
    }*/
    
    public function TopSellProductData()
    {
        $this->setNavigation(['menu-item-topSellingProduct']);
        $data = Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->orderBy('top_selling_count','desc');
        return datatables()->eloquent($data)
           ->addColumn('prpductCheckbox', function ($data) {
                return '<input type="checkbox" class="productCheck" name="productCheck[]" value="'.$data->id.'"/>';
            })     
            ->addColumn('image', function ($data) {
                if(!empty($data->product_image->image)){
                    $url = config("app.asset_url").'/images/product/'.$data->product_image->image;
                    return '<img src="' .$url. '" height="30" width="30\"/>';
                }else{
                    return 'No Image';
                }
            })
            ->addColumn('subCategory', function ($data){
                if(!empty($data->subCategories->subcategories)){
                   return $data->subCategories->subcategories->name;
                }else{
                    return '';
                }
            })
            ->addColumn('action', function ($modal) {
                return '<a href="'.route('view-product',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>
                  '; })
            ->addIndexColumn()
            ->rawColumns(['prpductCheckbox','image', 'action'])->make(true);
    }
    public function filterProducts(Request $request){
        $this->setNavigation(['menu-item-topSellingProduct']);
        try{
            $requestData = $request->all();
            $superCategoryName = ProductSuperCategory::where('id',$requestData['product_super_category'])->first('name');
            $categoryName = ProductCategory::where('id',$requestData['product_category'])->first('name');
            $subCategoryName = ProductSubcategory::where('id',$requestData['product_sub_category'])->first('name');
            $superCategories = ProductSuperCategory::all();
            $categories = ProductCategory::all();
            $subCategories = ProductSubcategory::all();
            return view('admin.TopSellingProduct.filter-results',compact('superCategories','categories','subCategories','superCategoryName','categoryName','subCategoryName'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('top_sell_product_list');
        }
    }
    /**
       * @method:    filter result
       * @purpose:   filter product result
       * @param Request $request
       * @return filtered product list
    */
    public function filterResults(Request $request){
        $this->setNavigation(['menu-item-topSellingProduct']);
        try{
            $prdSupCat = $request['product_super_category'];
            $prdCat = $request['product_category'];
            $prdSubCat = $request['product_sub_category'];

            if(!empty(isset($prdSupCat))  && !empty(isset($prdCat)) && !empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->where('category_id',$prdCat)
                    ->where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSupCat))  && !empty(isset($prdCat))) {
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->where('category_id',$prdCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSupCat)) && !empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdCat)) && !empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('category_id',$prdCat)
                    ->where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSupCat))){
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->whereIn('id',$productIds);
            }elseif(!empty(isset($prdCat))){
                $productIds = ProductCategorySubCategory::where('category_id',$prdCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->where([['status',1],['top_selling_count','>','0']])->whereIn('id',$productIds);
            }
            return  datatables()->eloquent($data)
                ->addColumn('image', function ($data) {
                    if(!empty($data->product_image->image)){
                        $url = config("app.asset_url").'images/product/'.$data->product_image->image;
                        return '<img src="' .$url. '" height="30" width="30\"/>';
                    }else{
                        return 'No Image';
                    }
                })                
                ->addColumn('subCategory', function ($data){
                    if(!empty($data->subCategories->subcategories)){
                        return $data->subCategories->subcategories->name;
                    }else{
                        return '';
                    }
                })
                ->addColumn('action', function ($modal) {  
                    return '<a href="'.route('view-product',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>'; })
                ->addIndexColumn()
                ->rawColumns(['image','subCategory', 'action'])->make(true);
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('top-filter-products');
        }
    }
    public function export()
    {
        $this->setNavigation(['menu-item-topSellingProduct']);
        try{
            return Excel::download(new TopSellProductExport, 'TopSellProductExport.xlsx');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
}