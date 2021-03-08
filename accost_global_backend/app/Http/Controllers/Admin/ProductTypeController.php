<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductType;
use App\Tax;
use Illuminate\Http\Request;
use App\Lib\Validators\ProductTypeValidator;
class ProductTypeController extends Controller
{

    /**
     * @method      : addProductType
     * @params      : Request, id
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To add product type
     * @return_type : view
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function addProductType(){
        $this->setNavigation(['menu-item-taxes']);
        try{
            return view('admin.ProductTypes.new');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : saveProductType
     * @params      : Request
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To save product type
     * @return_type : view
     */
    public function saveProductType(Request $request){
        $this->setNavigation(['menu-item-taxes']);
        $this->validate($request, ProductTypeValidator::SAVE_PRODUCT_TYPE);
        try{
            $requestData = $request->all();
            ProductType::create($requestData);
            flash('Product type added successfully.')->success();
            return redirect()->route('list-product-type');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : listProductType
     * @params      : []
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To list product types
     * @return_type : view
     */
    public function listProductType(){
        $this->setNavigation(['menu-item-taxes']);
        try{
            return view('admin.ProductTypes.list');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : productTypeData
     * @params      : []
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To get product type data for data tables
     * @return      : json
     */
    public function productTypeData()
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $data = ProductType::all();
            return datatables()->Collection($data)
                ->addColumn('action', function ($id) {
                    return '<a href="'.route('view-product-type',$id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('edit-product-type',$id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-product-type',$id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';})
                ->addIndexColumn()
                ->toJson();
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : viewProductType
     * @params      : id
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To view product type details
     * @return      : view
     */
    public function viewProductType($id)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $productType = ProductType::whereId($id)->first();
            if(empty($productType)){
                flash('Invalid product type #id.')->error();
                return redirect()->route('list-product-type');  
            }
            return view('admin.ProductTypes.details', compact('productType'));
        }catch(\Exception $e){
            flash('Invalid product type #id.')->error();
            return redirect()->route('list-product-type');
        }
    }

    /**
     * @method      : editProductType
     * @params      : id
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To edit product type details
     * @return      : view
     */
    public function editProductType($id)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $productType = ProductType::whereId($id)->first();
            if(empty($productType)){
                flash('Invalid product type #id.')->error();
                return redirect()->route('list-product-type');
            }
            return view('admin.ProductTypes.edit', compact('productType'));
        }catch(\Exception $e){
            flash('Invalid product type #id.')->error();
            return redirect()->route('list-product-type'); 
        }
    }

    /**
     * @method      : updateProductType
     * @params      : Request, id
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To update product type
     * @return_type : route
     */
    public function updateProductType(Request $request,$id){
        $this->setNavigation(['menu-item-taxes']);
        $this->validate($request, ProductTypeValidator::SAVE_PRODUCT_TYPE);
        try{
            ProductType::whereId($id)->update($request->except(['_token']));
            flash('Product type updated successfully.')->success();
            return redirect()->route('list-product-type');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : deleteProductType
     * @params      : id
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To delete product type details
     * @return      : route
     *
     * Before Delete check following conditions
     * 1. do not delete if taxes are present under this Taxable Product Type
     * 2. do not delete if product are present under this Taxable Product Type
     */
    public function deleteProductType($id)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            # check if taxes are present under
            $check = Tax::where('tax_product_type_id',$id)->first();
            if ($check) {
                flash('Cannot delete! Taxes are present under this taxable product type.')->error();
                return redirect()->back();
            }
            # check if products are present under this
            $check = Product::where('tax_product_type_id',$id)->first();
            if ($check) {
                flash('Cannot delete! Products are present under this taxable product type.')->error();
                return redirect()->back();
            }
            ProductType::where('id',$id)->delete();
            flash('Product type deleted successfully.')->success();
            return redirect()->route('list-product-type');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * @method      : findUniqueType
     * @params      : Request $request
     * @developer   :
     * @purpose     : To check unique product type
     * @return      : json response
    */
    public function findUniqueType(Request $request){
        $this->setNavigation(['menu-item-taxes']);
        if($request->prev_type_id!=0){
            $ProductType=ProductType::find($request->prev_type_id);
            if($ProductType->type==$request->product_type){
                return response()->json(['status'=>0,'message'=>"Previous Product Type."], 200);
            }
        }
        $ProductType= ProductType::whereType($request->product_type)->get();
        if(count($ProductType)>0){
            return response()->json(['status'=>1,'message'=>'Product Type already exist.'],200);
        }else{
            return response()->json(['status'=>'0','message'=>'Product type not exist.'],200);
        }
    }

}
