<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\Validators\ProductCategoryValidators;
use App\ProductCategory;
use App\CouponsCategory;
use App\CouponsProduct;
use App\ProductSuperCategory;
use App\Traits\UploadTrait;

use Illuminate\Http\Request;

class ProductSuperCategoryController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * view new product super category form
     * updated: 01-Jan-2020
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newSuperCategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        return view('admin.ProductSuperCategory.new-super-category');
    }
    /**
     * save new product super category to database
     * updated: 01-Jan-2020
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSuperCategory(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        $requestData = $request->except('_token');
        $this->validate($request, ProductCategoryValidators::PRODUCT_SUPER_CATEGORY);
        try {
            # check if slug is already present
            $check_slug = ProductSuperCategory::where('slug','=', $requestData['slug'])->first('id');
            if($check_slug){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move(public_path().'/images/super-category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/super-category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/super-category'), 180, 245,$filename);
                        $requestData['icon'] = $filename;
                    }
                }
                ProductSuperCategory::create($requestData);
                flash('Product Super category added successfully.')->success();
                return redirect()->route('listSuperCategory');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }    
    /**
     * view list of product super categories
     * updated: 01-Dec-2020
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSuperCategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        return view('admin.ProductSuperCategory.view');
    }
    /**
     * return product super categories data for data-table
     * updated: 01-Dec-2020
     * @return JsonResponse
     */
    public function superCatData()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        $data = ProductSuperCategory::all();
        return datatables()->Collection($data)
            ->addColumn('action', function (ProductSuperCategory $modal){
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                $featureIcon = ($modal->is_featured == 0) ? '<i class="fas fa-award"></i>' : '<i class="fas fa-award text-success"></i>';
                # Without is_featured link
                return '<a href="'.route('detail-super-category',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSuperCategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp&nbsp
                <a href="'.route('edit-super-category',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-super-category',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';
                # With is_featured link
                /*return '<a href="'.route('detail-super-category',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSuperCategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSuperCategory','column'=>'is_featured','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Featured">'.$featureIcon.'</a>&nbsp&nbsp
                <a href="'.route('edit-super-category',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-super-category',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';*/ })
            ->addIndexColumn()
            ->toJson();
    }
    /**
     * show product super category edit form
     * updated: 01-Dec-2020
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        try {
            $product_super_category = ProductSuperCategory::where('id','=',$id)->firstOrfail();
            return view('admin.ProductSuperCategory.edit', compact('product_super_category'));
        } catch (\Exception $e) {
            flash('Invalid product super category #id')->error();
            return redirect()->route('listSuperCategory');
        }
    }
    /**
     * update product super category
     * updated: 01-Dec-2020
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        $this->validate($request, ProductCategoryValidators::UPDATE_PRODUCT_SUPER_CATEGORY);
        try {
            $requestData = $request->except('_token');
            # check if slug is already present
            $check_slug = ProductSuperCategory::where('id', '!=', $id)->where('slug', '=', $requestData['slug'])->first('id');
            if($check_slug){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    $supCat = ProductSuperCategory::where('id', $id)->first('icon');
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move( public_path().'/images/super-category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/super-category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/super-category'), 180, 245,$filename);
                        $requestData['icon'] = $filename;
                    }
                }
                ProductSuperCategory::where('id',$id)->update($requestData);
                flash('Super Category updated successfully.')->success();
                return redirect()->route('listSuperCategory');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * delete product super category only when no category is present under super category
     * updated: 01-Dec-2020
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        try {
            $category = ProductCategory::where('product_super_category_id', $id)->firstOrFail();
        } catch (\Exception $e) {
            CouponsCategory::where([['product_category_id',$id]])->delete();
            ProductSuperCategory::where('id',$id)->delete();
            flash('Super Category deleted successfully.')->success();
            return redirect()->back();
        }
        flash('Cannot delete, first delete the categories under it.')->error();
        return redirect()->back();
    }
    /**
     * view product super category details
     * updated: 01-Dec-2020
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-super-category']);
        try {
            $product_super_category = ProductSuperCategory::where('id',$id)->firstOrfail();
            return view('admin.ProductSuperCategory.detail',compact('product_super_category'));
        } catch (\Exception $e) {
            flash('Invalid product super category #id')->error();
            return redirect()->route('listSuperCategory');
        }        
    }
}