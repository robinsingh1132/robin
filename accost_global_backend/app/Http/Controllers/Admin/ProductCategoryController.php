<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\Validators\ProductCategoryValidators;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductSuperCategory;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class ProductCategoryController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * view new product category form
     * updated: 22-Nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        $pro_super_categories = ProductSuperCategory::all();
        return view('admin.ProductCategory.new-category', compact('pro_super_categories'));
    }
    /**
     * save new product category to database
     * updated: 22-Nov-2019
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCategory(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        $this->validate($request, ProductCategoryValidators::PRODUCT_CATEGORY);
        try {
            $requestData = $request->except('_token');
            # check if slug is already present
            $check_slug = ProductCategory::where('slug','=', $request['slug'])->first('id');
            if(!empty($check_slug)){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move(public_path().'/images/category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/category'), 180, 245,$filename);                        
                        $requestData['icon'] = $filename;
                    }
                }
                ProductCategory::create($requestData);
                flash('Product category added successfully.')->success();
                return redirect()->route('pro-category');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }    
    /**
     * view list of product categories
     * updated: 22-nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listCategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        return view('admin.ProductCategory.view');
    }
    /**
     * return product categories data for data-table
     * updated: 22-nov-2019
     * @return JsonResponse
     */
    public function productCatData()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        if(isset($_GET['product_category'])){
            $data = ProductCategory::with('superCategory')->where('product_super_category_id','=',$_GET['product_category']);
        }else{
            $data = ProductCategory::with('superCategory');
        }
        return datatables()->eloquent($data)
            ->addColumn('action', function (ProductCategory $modal) {
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                $featureIcon = ($modal->is_featured == 0) ? '<i class="fas fa-award"></i>' : '<i class="fas fa-award text-success"></i>';
                # without is_featured link
                return '<a href="'.route('detail-pro-category',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductCategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp&nbsp
                <a href="'.route('edit-pro-category',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-pro-category',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';
                # with is_featured link
                /*return '<a href="'.route('detail-pro-category',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductCategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductCategory','column'=>'is_featured','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Featured">'.$featureIcon.'</a>&nbsp&nbsp
                <a href="'.route('edit-pro-category',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-pro-category',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';*/ })
            ->addIndexColumn()
            ->toJson();
    }
    /**
     * show product category edit form
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        try {
            $product_category = ProductCategory::where('id','=',$id)->firstOrfail();
            $pro_super_categories = ProductSuperCategory::all();
            return view('admin.ProductCategory.edit', compact('product_category', 'pro_super_categories'));
        } catch (\Exception $e) {
            flash('Invalid product category #id')->error();
            return redirect()->route('pro-category');
        }
    }
    /**
     * update product category
     * updated: 22-nov-2019
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        $this->validate($request, ProductCategoryValidators::UPDATE_PRODUCT_CATEGORY);
        try {
            $requestData = $request->except('_token');
            # check if slug is already present
            $check_slug = ProductCategory::where('id', '!=', $id)->where('slug', '=', $request['slug'])->first('id');
            if(!empty($check_slug)){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    $cat = ProductCategory::where('id', $id)->first('icon');
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move( public_path().'/images/category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/category'), 180, 245,$filename);
                        $requestData['icon'] = $filename;
                    }
                }
                ProductCategory::where('id',$id)->update($requestData);
                flash('Product Category updated successfully.')->success();
                return redirect()->route('pro-category');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * delete product category only when no subcategory is present under category
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        try {
            $subcategory = ProductSubcategory::where('product_category_id', $id)->firstOrFail();
        } catch (\Exception $e) {
            ProductCategory::where('id',$id)->delete();
            flash('Category deleted successfully.')->success();
            return redirect()->back();
        }
        flash('Cannot delete, first delete the subcategories under it.')->error();
        return redirect()->back();
    }
    /**
     * view product category details
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-product-category']);
        try {
            $pro_super_categories = ProductSuperCategory::all();
            $product_category = ProductCategory::where('id',$id)->firstOrfail();
            return view('admin.ProductCategory.detail',compact('product_category','pro_super_categories'));
        } catch (\Exception $e) {
            flash('Invalid product category #id')->error();
            return redirect()->route('pro-category');
        }
    }
}
