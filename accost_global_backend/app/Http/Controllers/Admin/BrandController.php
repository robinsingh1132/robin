<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductSuperCategory;
use App\Brand;
use App\Product;
use App\Lib\Validators\BrandValidators;
use App\Traits\UploadTrait;

class BrandController extends Controller
{
  use UploadTrait;
  public function __construct()
  {
    parent::__construct();
  }
  /**
   * @method:    addBrand
   * @purpose:   Add Brand
   * @param null
   * @return new blade
  */
  public function addBrand()
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    $pro_super_categories = ProductSuperCategory::where('status',1)->get();
    return view('admin.Brand.new', compact('pro_super_categories'));
  }
  /**
   * @method:      saveBrand
   * @purpose:     Save brand
   * @param Request $request
   * @return null
   */
  public function saveBrand(Request $request)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    $this->validate($request, BrandValidators::SAVE_BRAND);
      try {
        $requestData = [
            'brand_name'         =>  $request->brand_name,
            'super_category_id'  =>  $request->super_category_id,
            'slug'               =>  $request->slug,
            'status'             =>  $request->status,
        ];
        if($request->hasFile('icon')) {
            if($request->file('icon')->isValid()){
                $image = $request->file('icon');
                $filename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path().'/images/brand/', $filename) ;
                $this->ResizeImageThumbnail(public_path('images/brand'), 200, 200,$filename);
                $requestData['icon'] = $filename;
            }
        }
        Brand::create($requestData);
        flash('Brand added successfully.')->success();
        return redirect()->route('list-brand');
      } catch (\Exception $e) {
        flash($e->getMessage())->error();
        return redirect()->back();
      }
  } 
  /**
   * @method:    listBrand 
   * @purpose:   view all brand
   * @return list view blade
  */
  public function listBrand()
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    return view('admin.Brand.list');
  }
  /**
   * @method:    brandData
   * @purpose:   list view brand data
   * @return json response
  */
  public function brandData()
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    $data = Brand::with('superCategory');
    return datatables()->eloquent($data)
      ->addColumn('action', function (Brand $modal) {
          $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
          return '<a href="'.route('detail-brand',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
          <a href="'.route('toggle-status',['model'=>'Brand','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
          <a href="'.route('edit-brand',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
          <a href="'.route('delete-brand',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this Brand?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
            '; })
      ->addIndexColumn()
      ->toJson();
  }
  /**
   * @method:    edit
   * @purpose:   edit brand
   * @param $id
   * @return edit view blade
  */
  public function edit($id)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    try {
      $brand = Brand::where('id','=',$id)->firstOrfail();
      $pro_super_categories = ProductSuperCategory::where('status',1)->get();
      return view('admin.Brand.edit', compact('brand', 'pro_super_categories'));
    } catch (\Exception $e) {
      flash('Invalid brand #id')->error();
      return redirect()->route('list-brand');
    }
  }
  /**
   * @method:    update
   * @purpose:   update brand
   * @param Request $request, $id
   * @return updated data
  */
  public function update(Request $request, $id)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    $this->validate($request, BrandValidators::UPDATE_BRAND);
    try{
      $requestData = $request->except('_token');
      if($request->hasFile('icon')) {
        if($request->file('icon')->isValid()){
          $image = $request->file('icon');
          $filename = time() . '-' . $image->getClientOriginalName();
          $image->move( public_path().'/images/brand/', $filename) ;
          $this->ResizeImageThumbnail(public_path('images/brand'), 200, 200,$filename);
          $requestData['icon'] = $filename;
        }
      }
      Brand::where('id',$id)->update($requestData);
      flash('Brand updated successfully.')->success();
      return redirect()->route('list-brand');
    }catch (\Exception $e) {
      flash($e->getMessage())->error();
      return redirect()->back();
    }
  }
  /**
   * @method:    destroy
   * @purpose:   delete brand
   * @param $id
   * @return null
  */
  public function destroy($id)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    try {
      $product=Product::where('brand_id', $id)->firstOrFail();      
    }catch (\Exception $e) {
      Brand::where('id',$id)->delete();
      flash('Brand deleted successfully.')->success();
      return redirect()->route('list-brand');      
    }
    flash("You can't delete this brand because some products are added under this brand, you need  to remove the products first.")->error();
    return redirect()->back();
  }
  /**
   * @method:    view
   * @purpose:   view brand
   * @param $id
   * @return null
  */
  public function view($id)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    try {
      $pro_super_categories = ProductSuperCategory::where('status',1)->get();
      $brand = Brand::where('id',$id)->firstOrfail();
      return view('admin.Brand.detail',compact('brand','pro_super_categories'));
    } catch (\Exception $e) {
      flash('Invalid brand #id')->error();
      return redirect()->route('list-brand');
    }    
  }
  /**
   * @method:    findUniqueBrand
   * @purpose:   check unique brand name
   * @param Request $request
   * @return json response
  */
  public function findUniqueBrand(Request $request)
  {
    $this->setNavigation(['menu-item-catalog','menu-item-brand']);
    if($request->prev_brand_id!=0){
      $brand=Brand::find($request->prev_brand_id);
      if($brand->brand_name==$request->brand_name){
        return response()->json(['status'=>0,'message'=>"Previous brand."], 200);
      }
    
      $brand= Brand::where('brand_name',$request->brand_name)->get();
      if(count($brand)>0){
        return response()->json(['status'=>'1','message'=>'Brand name already exist.'],200);
      }else{
        return response()->json(['status'=>'0','message'=>'Brand name not exist.'],200);
      }
    }
  }
}