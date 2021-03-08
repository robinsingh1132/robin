<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\Validators\ProductSubcategoryValidators;
use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;


class ProductSubcategoryController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * view new product subcategory form
     * updated: 22-Nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newSubcategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        $pro_categories = ProductCategory::select('id','name')->get();
        return view('admin.ProductSubcategory.new-subcategory', compact('pro_categories'));

    }
    /**
     * save new product subcategory to database
     * updated: 22-Nov-2019
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSubcategory(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        $this->validate($request, ProductSubcategoryValidators::PRODUCT_SUBCATEGORY);
        try {
            $requestData = $request->except('_token');
            # check if slug is already present
            $check_slug = ProductSubcategory::where('slug','=',$request['slug'])->first('id');
            if(!empty($check_slug)){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move(public_path().'/images/sub-category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/sub-category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/sub-category'), 180, 245,$filename);
                        $this->ResizeImageThumbnail(public_path('images/sub-category'),410, 736,$filename);                      
                        $requestData['icon'] = $filename;
                    }
                }
                ProductSubcategory::create($requestData);
                flash('Product subcategory added successfully.')->success();
                return redirect()->route('list-pro-subcat');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * view list of product subcategories
     * updated: 22-nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSubcategory()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        $product_categories = ProductCategory::all();
        return view('admin.ProductSubcategory.list', compact('product_categories'));
    }
    /**
     * return product subcategories data for data-table
     * updated: 26-nov-2019
     * @return JsonResponse
     */
    public function productSubcatData(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        if(isset($_GET['product_category'])){
            $data = ProductSubcategory::with('productCategory')->where('product_category_id','=',$_GET['product_category']);
        }else{
            $data = ProductSubcategory::with('productCategory');
        }
        return datatables()->eloquent($data)
            ->addColumn('action', function (ProductSubcategory $modal) {
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                $featureIcon = ($modal->is_featured == 0) ? '<i class="fas fa-award"></i>' : '<i class="fas fa-award text-success"></i>';
                # without is_featured link
                return '<a href="'.route('view-pro-subcat',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSubcategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
                <a href="'.route('edit-pro-subcat',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-pro-subcat',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';
                # With is_featured link
                /*return '<a href="'.route('view-pro-subcat',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSubcategory','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
                <a href="'.route('toggle-status',['model'=>'ProductSubcategory','column'=>'is_featured','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Featured">'.$featureIcon.'</a>&nbsp
                <a href="'.route('edit-pro-subcat',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-pro-subcat',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';*/ })
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * show product subcategory edit form
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        try {
            $product_subcategory = ProductSubcategory::where('id','=',$id)->firstOrfail();
            $pro_categories = ProductCategory::select('id','name')->get();
            return view('admin.ProductSubcategory.edit', compact('product_subcategory','pro_categories'));
        } catch (\Exception $e) {
            flash('Invalid product subcategory #id.')->error();
            return redirect()->route('list-pro-subcat');
        }
    }

    /**
     * update product subcategory
     * updated: 22-nov-2019
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        $this->validate($request, ProductSubcategoryValidators::UPDATE_PRODUCT_SUBCATEGORY);
        try {
            $requestData = $request->except('_token');
            # check if slug is already present
            $check_slug = ProductSubcategory::where('id','!=', $id)->where('slug','=',$request['slug'])->first('id');
            if(!empty($check_slug)){
                flash('Slug is already present')->error();
                return redirect()->back();
            }else{
                if($request->hasFile('icon')) {
                    $subCat = ProductSubcategory::where('id', $id)->first('icon');
                    if($request->file('icon')->isValid()){
                        $image = $request->file('icon');
                        $filename = time() . '-' . $image->getClientOriginalName();
                        $image->move( public_path().'/images/sub-category/', $filename) ;
                        $this->ResizeImageThumbnail(public_path('images/sub-category'), 800, 800,$filename);
                        $this->ResizeImageThumbnail(public_path('images/sub-category'), 180, 245,$filename);
                        $this->ResizeImageThumbnail(public_path('images/sub-category'), 410, 736,$filename); 
                        $requestData['icon'] = $filename;
                    }
                }
                ProductSubcategory::where('id',$id)->update($requestData);
                flash('Product subcategory updated successfully.')->success();
                return redirect()->route('list-pro-subcat');
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * delete product subcategory only when no subcategory is present under category
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        ProductSubcategory::where('id',$id)->delete();
        flash('Subcategory deleted successfully.')->success();
        return redirect()->back();
    }
    /**
     * view product subcategory details
     * updated: 22-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-sub-category']);
        try {
            $product_subcategory = ProductSubcategory::where('id',$id)->with('productCategory')->firstOrfail();
            return view('admin.ProductSubcategory.detail',compact('product_subcategory'));
        } catch (\Exception $e) {
            flash('Invalid product subcategory #id.')->error();
            return redirect()->route('list-pro-subcat');
        }
    }
}