<?php

namespace App\Http\Controllers\Admin;

use App\Highlight;
use App\Product;
use App\UserCart;
use App\Brand;
use App\ProductSetPrice;
use App\ProductStock;
use App\ProductTag;
use App\ProductCategory;
use App\ProductCategorySubCategory;
use App\ProductImage;
use App\ProductSet;
use App\ProductSize;
use App\ProductHighlight;
use App\ProductSubcategory;
use App\ProductSuperCategory;
use App\ProductType;
use App\RelatedProduct;
use App\CouponsProduct;
use App\HighlightsSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lib\Validators\ProductValidator;
use Intervention\Image\Facades\Image;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        parent::__construct();
    }
    /**
       * @method:   productList 
       * @purpose:  Product list view
       * @param null
       * @return list view blade
    */
    public function productList()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $superCategories = ProductSuperCategory::all();
        $categories = ProductCategory::all();
        $subCategories = ProductSubcategory::all();
        return view('admin.Product.list',compact('superCategories','categories','subCategories'));
    }
    /**
       * @method:    newProduct
       * @purpose:   add product
       * @param null
       * @return add new product blade
    */
    public function newProduct()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $superCategories = ProductSuperCategory::all();
        $categories = ProductCategory::all();
        $subCategories = ProductSubcategory::all();
        $highlights = HighlightsSubCategory::all();
        $productType = ProductType::all();
        $products = Product::with('subCategories')->get();
        return view('admin.Product.new',compact('products','superCategories','categories','subCategories','productType'));
    }
    /**
       * @method:    saveProduct
       * @purpose:   save product
       * @param Request $request
       * @return null
    */    
    public function saveProduct(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $this->validate($request, ProductValidator::PRODUCT);
        try{
            $requestData = $request->all();            
            $productData = [
                'name' => $requestData['name'],
                'sku' => $requestData['sku'],
                'brand_id' => $requestData['brand_id'],
                'product_details' => $requestData['product_details'],
                'additional_details' => $requestData['additional_details'],
                'term_and_condition' => $requestData['term_and_condition'],
                'is_featured' => $requestData['is_featured'],
                'is_free_shipping' => $requestData['is_free_shipping'],
                'is_review_allowed' => $requestData['is_review_allowed'],
                'tax_product_type_id' => $requestData['product_type'],
                'status' => 1, 
            ];
            $productId = Product::insertGetId($productData);
            if(!empty($productId)){
                $productCatData = [
                    'product_id' => $productId,
                    'super_category_id' => $requestData['super_category_id'],
                    'category_id' => $requestData['category_id'],
                    'subcategory_id' => $requestData['subcategory_id'],
                ];
                ProductCategorySubCategory::create($productCatData);
            }
            return response()->json($productId);
        }catch(\Exception $e){
            //flash($e->getMessage())->error();
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
     * This method save the product size with their sets.
     * This method accepts the request parameter and product id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProductSize(Request $request,$id){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        #$this->validate($request, ProductValidator::PRODUCT_SIZE);
        try{
            /*delete all foraign keys based on product sizes*/
            ProductStock::where('product_id',$id)->delete();
            ProductSetPrice::where('product_id',$id)->delete();
            ProductSet::where('product_id',$id)->delete();
            $arr_sizes = $values_product_sizes = array();
            $arr_original_price = array();
            $arr_set_price = array();
            $values_product_sets = array();
            $curr_time = Carbon::now();
            # Step 1: get the unique size names and original price and insert into table
            foreach ($request->arr_product_size as $item) {
                array_push($arr_sizes, $item['_size_name']);
                $arr_original_price[$item['_size_name']] = $item['_o_price'];
                $temp = [
                    '_size_name' => $item['_size_name'],
                    '_min_qty' => $item['_min_qty'],
                    '_max_qty' => $item['_max_qty'],
                    '_s_price' => $item['_s_price']
                ];
                array_push($arr_set_price, $temp);
            }
            $arr_sizes = array_unique($arr_sizes);
            foreach ($arr_sizes as $value) {
                $temp = [
                    'product_id' => $id,
                    'size' => $value,
                    'price' => $arr_original_price[$value],
                    'updated_at' => $curr_time,
                    'created_at' => $curr_time
                ];                
                array_push($values_product_sizes, $temp);
            }
            ProductSize::where('product_id',$id)->delete();
            ProductSize::insert($values_product_sizes);

            # Step 2: get unique sets of each sizes and insert into table
            $product_sizes = ProductSize::where('product_id',$id)->get();
            foreach ($product_sizes as $size) {
                foreach ($arr_set_price as $value) {
                    if ($value['_size_name'] == $size->size) {
                        $temp = ['product_id' => $id, 'product_size_id' => $size->id, 'set_min' => $value['_min_qty'], 'set_max' => $value['_max_qty']];
                        $record = ProductSet::create($temp);
                        # prepare record for insert into product_set_prices
                        $temp['product_set_id'] = $record->id;
                        $temp['price'] = $value['_s_price'];
                        $temp['updated_at'] = $curr_time;
                        $temp['created_at'] = $curr_time;
                        array_push($values_product_sets, $temp);
                    }
                }
            }
            # Step 3: insert into product set prices
            ProductSetPrice::insert($values_product_sets);
            return response()->json($id);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    deleteProductSize
       * @purpose:   delete product size
       * @param $product_id = null, $size_id = null
       * @return json response
    */
    public function deleteProductSize($product_id = null, $size_id = null)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try {
                $size=ProductSize::where(['id'=>$size_id,'product_id'=>$product_id])->delete();
            return response()->json($size);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    productData
       * @purpose:   product list data
       * @param null
       * @return product list data
    */
    public function productData()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $data = Product::with('product_image','subCategories.subcategories');
        return datatables()->eloquent($data)
           ->addColumn('prpductCheckbox', function ($data) {
                return '<input type="checkbox" class="productCheck" name="productCheck[]" value="'.$data->id.'"/>';
            })
            ->addColumn('url', function ($data) {
                return $data->product_page_slug;
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
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                $featureIcon = ($modal->is_featured == 0) ? '<i class="fas fa-award"></i>' : '<i class="fas fa-award text-success"></i>';
                $cart_product_exist=UserCart::where([['product_id',$modal->id]])->get()->count();
                if($cart_product_exist>0){
                    $onclick='onclick="return confirm(\'This product is added in some Users cart, are you sure you want to delete?\');';
                    $onclick_status='onclick="return confirm(\'This product is added in some Users cart, are you sure you want to update his status?\');';
                }else{
                    $onclick='onclick="return confirm(\'Are you sure you want to delete this item?\');';
                    $onclick_status='onclick="return confirm(\'Are you sure you want to update his status?\');';
                }
                return '<a href="'.route('view-product',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('status-update',$modal->id).'" '.$onclick_status.'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp                
                <a href="'.route('toggle-status',['model'=>'Product','column'=>'is_featured','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Featured">'.$featureIcon.'</a>&nbsp&nbsp
                <a href="'.route('edit-product',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-product',$modal->id).'" '.$onclick.'" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>

                  '; })
            ->addIndexColumn()
            ->rawColumns(['prpductCheckbox','image', 'action'])->make(true);
//            ->toJson();
    }
    /**
       * @method:    viewProduct
       * @purpose:   view product detail
       * @param $id
       * @return view blade
    */
    public function viewProduct($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            $superCategories = ProductSuperCategory::all();
            $categories = ProductCategory::all();
            $subCategories = ProductSubcategory::all();
            $productType = ProductType::all();
            $rel_product_ids=RelatedProduct::with('product')->where('product_id',$id)->get('related_product_id');
            $product_images=ProductImage::whereProductId($id)->get();
            $product = Product::with('productTag','productSet')->whereId($id)->firstOrFail();
            $product_tags=$product->productTag->toArray();
            $tag_name= implode(', ', array_column($product_tags, 'tag_name'));
            $product_super_cat = ProductCategorySubCategory::where('product_id',$id)->select('super_category_id')->distinct()->get();
            $product_cat = ProductCategorySubCategory::where('product_id',$id)->select('category_id')->distinct()->get();
            $product_sub_cat = ProductCategorySubCategory::where('product_id',$id)->select('subcategory_id')->distinct()->get();
            $super_cat_id=$product_super_cat->first()->super_category_id;
            $brands=Brand::where('super_category_id',$super_cat_id)->get(); 
            //super category
            foreach($product_super_cat as $item){
                $supCat[] = $item->super_category_id;
            }
            //category
            foreach($product_cat as $item){
                $Cat[] = $item->category_id;
            }
            //sub category
            foreach($product_sub_cat as $item){
                $subCat[] = $item->subcategory_id;
            }
            $product_super_cat = $supCat;
            $product_cat = $Cat;
            $product_sub_cat = $subCat;
            # get product set and sizes
            $arr_product_sets = array();
            $product_sets = ProductSetPrice::where('product_id',$id)->with('productSize')->get();
            foreach ($product_sets as $set) {
                $temp = [
                    '_size_name' => $set->productSize->size,
                    '_o_price' => $set->productSize->price,
                    '_min_qty' => $set->set_min,
                    '_max_qty' => $set->set_max,
                    '_s_price' => $set->price
                ];
                array_push($arr_product_sets, $temp);
            }
            return view('admin.Product.detail',compact('arr_product_sets','product','superCategories','categories','subCategories','productType','product_super_cat','product_cat','product_sub_cat','tag_name','rel_product_ids','product_images','brands'));
        }catch(\Exception $e){
            flash('Invalid Product #id.')->error();
            return redirect()->route('product-list');
        }
    } 
    /**
       * @method:    editProduct
       * @purpose:   edit product
       * @param $id
       * @return edit view blade
    */   
    public function editProduct($id){
        if(!empty($id)){
            $product = Product::find($id);
            if(empty($product)){
                flash('Invalid Product #id.')->error();
                return redirect()->route('product-list');
            }
        }
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $current_tab='';
        $id=urldecode($id);
        $id=explode('-', $id);
        $count=count($id);
        for($i=1;$count>$i;$i++){
            if($i==1){
                $current_tab.=$id[$i];
            }else{
                $current_tab.='-'.$id[$i];
            }            
        }
        $id=$id[0];
        $superCategories = ProductSuperCategory::all();
        $categories = ProductCategory::all();
        $subCategories = ProductSubcategory::all();
        $productType = ProductType::all();
        $product = Product::with('subCategories','productSize','productSet','productHighlight','productTag')->whereId($id)
            ->get()->first();
        $product_tags=$product->productTag->toArray();
        $tag_name= implode(', ', array_column($product_tags, 'tag_name'));
        $allproducts=Product::with('getRelatedProduct')->where([['id','!=',$id]])->get();
        $curr_prod_rel_product_ids=RelatedProduct::where('product_id',$id)->get('related_product_id');
        # get product set and sizes
        $arr_product_sets = array();
        $product_sets = ProductSetPrice::where('product_id',$id)->with('productSize')->get();
        foreach ($product_sets as $set) {
            $temp = [
                '_size_name' => $set->productSize->size,
                '_o_price' => $set->productSize->price,
                '_min_qty' => $set->set_min,
                '_max_qty' => $set->set_max,
                '_s_price' => $set->price
            ];
            array_push($arr_product_sets, $temp);
        }
        return view('admin.Product.edit.edit',compact('arr_product_sets','product','superCategories','categories', 'subCategories','productType','allproducts','curr_prod_rel_product_ids','tag_name','current_tab'));
    }
    /**
       * @method:    updateProduct
       * @purpose:   update product
       * @param Request $request, $id
       * @return json response
    */
    public function updateProduct(Request $request, $id){
        $old_subcat_id=ProductCategorySubCategory::whereProductId($id)->get('subcategory_id')->first();
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $this->validate($request, ProductValidator::UPDATE_PRODUCT);
        try{
            $requestData = $request->all();            
            $productData = [
                'name' => $requestData['name'],
                'sku' => $requestData['sku'],
                'brand_id' => $requestData['brand_id'],
                'product_details' => $requestData['product_details'],
                'additional_details' => $requestData['additional_details'],
                'term_and_condition' => $requestData['term_and_condition'],
                'is_featured' => $requestData['is_featured'],
                'is_free_shipping' => $requestData['is_free_shipping'],
                'is_review_allowed' => $requestData['is_review_allowed'],
                'tax_product_type_id' => $requestData['product_type'],
                'status' => $requestData['status'],
            ];
            Product::whereId($id)->update($productData);
            if($id){
                    ProductCategorySubCategory::whereProductId($id)->delete(); 
                    if(!empty($old_subcat_id)){
                        if($old_subcat_id->subcategory_id != $request->subcategory_id){
                            ProductHighlight::whereProductId($id)->delete();
                        } 
                    }                                      
                    $productCatData = [
                        'product_id' => $id,
                        'super_category_id' => $requestData['super_category_id'],
                        'category_id' => $requestData['category_id'],
                        'subcategory_id' => $requestData['subcategory_id'],
                    ];
                    ProductCategorySubCategory::create($productCatData);
                    return response()->json($id);
            }else{
                return response()->json(['error'=>'Something went wrong'], 403);
            }
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    destroy
       * @purpose:   delete product
       * @param $id
       * @return null
    */
    public function destroy($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
         UserCart::where([['product_id',$id]])->delete();
        /*CouponsProduct::where([['products_id',$id]])->delete();
        ProductCategorySubCategory::where([['product_id',$id]])->delete();
        ProductSetPrice::where([['product_id',$id]])->delete();
        ProductSet::where([['product_id',$id]])->delete();
        ProductStock::where([['product_id',$id]])->delete();
        ProductSize::where([['product_id',$id]])->delete();
        ProductHighlight::where([['product_id',$id]])->delete();
        ProductImage::where([['product_id',$id]])->delete();
        RelatedProduct::where([['product_id',$id]])->delete();
        RelatedProduct::where('related_product_id',$id)->delete();
        ProductTag::where([['product_id',$id]])->delete();        */
        Product::where('id',$id)->delete();
        flash('Product deleted successfully.')->success();
        return redirect()->back();
    }
    /**
       * @method:    allProductDelete
       * @purpose:   delete all prodcut
       * @param Request $request
       * @return null
    */    
    public function allProductDelete(Request $request)
    {
        foreach ($request->productSelected as $id) {
            $this->setNavigation(['menu-item-catalog','menu-item-products']);
            UserCart::where([['product_id',$id]])->delete();
            /*CouponsProduct::where([['products_id',$id]])->delete();*/
            /*ProductCategorySubCategory::where([['product_id',$id]])->delete();*/
            /*ProductSetPrice::where([['product_id',$id]])->delete();*/
            /*ProductSet::where([['product_id',$id]])->delete();*/
            /*ProductStock::where([['product_id',$id]])->delete();*/
           /* ProductSize::where([['product_id',$id]])->delete();*/
            /*ProductHighlight::where([['product_id',$id]])->delete();*/
            /*ProductImage::where([['product_id',$id]])->delete();*/
            /*RelatedProduct::where([['product_id',$id]])->delete();*/
            /*RelatedProduct::where('related_product_id',$id)->delete();*/
            /*ProductTag::where([['product_id',$id]])->delete();*/        
            Product::where('id',$id)->delete();
        }
        flash('Product deleted successfully.')->success();
        return response()->json(['success'=>'Selected Product deleted successfully.'], 200);        
    }
    /**
       * @method:    fileStore
       * @purpose:   Add product image
       * @param Request $request, $pId = Null
       * @return json response
    */
    public function fileStore(Request $request, $pId = Null)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        if($pId){
            /*if(empty($request->file('product_image'))){
                return response()->json(['error'=>'Please add images first.']); 
            }*/
            foreach ($request->file('product_image') as $product_image) {
                $image = $product_image;
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/product'),$imageName);
                $imageName=$this->OptimizedProductImage($imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 200, 200,$imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 250, 250,$imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 700, 700,$imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 1200, 1200,$imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 80, 80,$imageName);
                $this->ResizeImageThumbnail(public_path('images/product'), 100, 100,$imageName);
                $imageUpload = new ProductImage();
                $imageUpload->product_id = $pId;
                if($request->is_header =='on'){
                    $is_header=1;
                    ProductImage::where('product_id',$pId)->update(['is_header'=>0]);
                }else{
                    $is_header=0;
                }
                $imageUpload->is_header = $is_header;
                $imageUpload->image = $imageName;
                $imageUpload->save();
                $product_images=ProductImage::find($pId);
            }
            return response()->json(['success'=>$imageName,'product_image'=>$product_images,'product_id'=>$pId]);
        }else{
            return response()->json(['error'=>'Please add product all details first.']);
        }
    }
    /**
       * @method:    OptimizedProductImage
       * @purpose:   optimize product image
       * @param $image_name
       * @return image name
    */
    public function OptimizedProductImage($image_name)
    {
        try {
            $img_name_only = explode('.', $image_name); 
            $img_name_only = $img_name_only[0];
            $image = new \Imagick(public_path('images/product/'.$image_name)); 
            // Set to use jpeg compression
            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
            // Set compression level (1 lowest quality, 100 highest quality)
            $image->setImageCompressionQuality(60);
            // Strip out unneeded meta data
            $image->stripImage();
            // Writes resultant image to output directory
            $image->writeImage(public_path('images/product/'.$img_name_only.'.jpeg'));
            $image->destroy();
            return $img_name_only.'.jpeg';
        } catch (\Exception $e) {
            echo $e->getMessage()."\n";
            return false;
        }
    }    
    /**
       * @method:    fileDestroy
       * @purpose:   delete file
       * @param $product_id = null, $image_id = null
       * @return null
    */
    public function fileDestroy($product_id = null, $image_id = null)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try {
            ProductImage::where(['id'=>$image_id,'product_id'=>$product_id])->delete();
            $product_images = ProductImage::where('product_id', $product_id)->get();
            return view('admin.Product.new-image-gallery', compact('product_images'))->render();
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    setPrimaryImage
       * @purpose:   Set image   
       * @param $product_id = null, $image_id = null
       * @return image blade
    */
    public function setPrimaryImage($product_id = null, $image_id = null)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try {
            ProductImage::where(['product_id'=>$product_id])->update(['is_header' => 0]);
            ProductImage::where(['id'=>$image_id,'product_id'=>$product_id])->update(['is_header' => 1]);
            $product_images = ProductImage::where('product_id', $product_id)->get();
            return view('admin.Product.new-image-gallery', compact('product_images'))->render();
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    getImages
       * @purpose:   get all images of product
       * @param Request $request
       * @return image data
    */
    public function getImages(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $product_images = ProductImage::where('product_id', $request->pId)->get();
        return view('admin.Product.new-image-gallery', compact('product_images'))->render();
    }
    /**
       * @method:    getProductCategory
       * @purpose:   get product category data
       * @param Request $request
       * @return json response : product category data
    */
    public function getProductCategory(Request $request){

        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            if(is_array($request['prod_super_cat_id'])){
                $condition = 'whereIn';
            }else{
                $condition = 'where';
            }
            $prodCategory = ProductCategory::$condition('product_super_category_id',$request['prod_super_cat_id'])->get();
            return response()->json($prodCategory);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    getBrand
       * @purpose:   get brand data
       * @param Request $request
       * @return json response:get brand data
    */
    public function getBrand(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{           
            $brands=Brand::where([['super_category_id',$request['prod_super_cat_id']],['status',1]])->orWhere('id',$request['old_brand_id'])->get();
            return response()->json($brands);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    getProductSubCategory
       * @purpose:   get product subcategory list
       * @param Request $request
       * @return json response: product subcategory
    */
    public function getProductSubCategory(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            if(is_array($request['prod_cat_id'])) {
                $condition = 'whereIn';
            }else{
                $condition = 'where';
            }
            $prodSubCategory = ProductSubcategory::$condition('product_category_id', $request['prod_cat_id'])->get();
            return response()->json($prodSubCategory);

        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    getRelatedProduct
       * @purpose:   get related product data
       * @param     Request $request
       * @return    related product data list
    */
    public function getRelatedProduct(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            $products=Product::with('sub_categories')->get();
            return view('admin.Product.related-product', compact('products'))->render();
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    saveRelatedProduct
       * @purpose:   save related product 
       * @param Request $request
       * @return json response
    */
    public function saveRelatedProduct(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            $related_product_data=[
                'product_id'    => $request->product_id,
                'related_product_id'  =>$request->related_product_id,
            ];
            # if related product id already present then delete else insert            
            $check_record = RelatedProduct::where(['product_id'=>$request->product_id,
                'related_product_id'=>$request->related_product_id])->get();
            if (count($check_record) > 0){
                # delete record
                $check_record->each->delete();
            }else{
                RelatedProduct::create($related_product_data);
            }
            return response()->json($request->product_id);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    saveProductTag
       * @purpose:   save product tags
       * @param Request $request,$id
       * @return json response: product id
    */
    public function saveProductTag(Request $request,$id){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        ProductTag::whereProductId($id)->delete();
        $tag_name=$request->tag_name;
        $tag_names=explode(',',$tag_name);
        try{
        foreach($tag_names as $tag_name){
            $product_tag_data=[
                'product_id'    => $id,
                'tag_name'  =>$tag_name,
            ];
            ProductTag::create($product_tag_data);
        }
            return response()->json($id);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    getHighlights
       * @purpose:   get highlight data
       * @param Request $request
       * @return view for highlight
    */
    public function getHighlights(Request $request)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{            
            $exist_highlight=ProductHighlight::where('product_id',$request['product_id'])->get();
            if(count($exist_highlight)>0){
                return view('admin.Product.new-product-highlight', compact('exist_highlight'))->render();
            }else{
                $subcategory=ProductCategorySubCategory::where('product_id',$request['product_id'])->first();
                $highlights=HighlightsSubCategory::with('highlight')->where('product_subcategories_id',$subcategory->subcategory_id)
                ->get();

                return view('admin.Product.new-product-highlight', compact('highlights'))->render();  
            }            
            
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    saveProductHighlight
       * @purpose:   save product highlights
       * @param Request $request,$id
       * @return json response
    */
    public function saveProductHighlight(Request $request,$id){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            ProductHighlight::whereProductId($id)->delete();
            $product_id = $id;
            $values = $request->except(['product_id','_token']);
            foreach ($values as $key => $value) {
                $temp = explode('_', $key);
                $record = Highlight::where('id', $temp[1])->first();
                $highlight_data = [
                    'product_id' => $product_id,
                    'highlight_id' => $record->id,
                    'highlight_name' => $record->name,
                    'highlight_value' => $value,
                ];
                ProductHighlight::create($highlight_data);
            }
            return response()->json($product_id);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    saveProductSeo
       * @purpose:   save product seo data
       * @param Request $request,$id
       * @return json response
    */
    public function saveProductSeo(Request $request,$id){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $this->validate($request, ProductValidator::PRODUCT_SEO);
        try{
            $requestData = $request->all();
            $seoData=[
                'page_title' =>  $requestData["page_title"],
                'seo_keywords' =>  $requestData["seo_keywords"],
                'seo_description' =>  $requestData["seo_description"],
                'product_page_slug' =>  $requestData["product_page_slug"],
            ];
            Product::whereId($id)->update($seoData);
            return response()->json($id);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()], 403);
        }
    }
    /**
       * @method:    filterProducts
       * @purpose:   filter product list
       * @param Request $request
       * @return product list blade
    */
    public function filterProducts(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            $requestData = $request->all();
            $superCategoryName = ProductSuperCategory::where('id',$requestData['product_super_category'])->first('name');
            $categoryName = ProductCategory::where('id',$requestData['product_category'])->first('name');
            $subCategoryName = ProductSubcategory::where('id',$requestData['product_sub_category'])->first('name');
            $superCategories = ProductSuperCategory::all();
            $categories = ProductCategory::all();
            $subCategories = ProductSubcategory::all();
            return view('admin.Product.filter-results',compact('superCategories','categories','subCategories','superCategoryName','categoryName','subCategoryName'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('product-list');
        }
    }
    /**
       * @method:    filter result
       * @purpose:   filter product result
       * @param Request $request
       * @return filtered product list
    */
    public function filterResults(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        try{
            $prdSupCat = $request['product_super_category'];
            $prdCat = $request['product_category'];
            $prdSubCat = $request['product_sub_category'];

            if(!empty(isset($prdSupCat))  && !empty(isset($prdCat)) && !empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->where('category_id',$prdCat)
                    ->where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSupCat))  && !empty(isset($prdCat))) {
                $productIds = ProductCategorySubCategory::where('super_category_id',$prdSupCat)
                    ->where('category_id',$prdCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
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
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdCat))){
                $productIds = ProductCategorySubCategory::where('category_id',$prdCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
            }elseif(!empty(isset($prdSubCat))){
                $productIds = ProductCategorySubCategory::where('subcategory_id',$prdSubCat)
                    ->distinct('product_id')->pluck('product_id')->toArray();
                $data = Product::with('product_image','subCategories.subcategories')->whereIn('id',$productIds);
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
                    $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                    $cart_product_exist=UserCart::where([['product_id',$modal->id]])->get()->count();
                    if($cart_product_exist>0){
                        $onclick='onclick="return confirm(\'This product is added in some Users cart, are you sure you want to delete?\');';
                        $onclick_status='onclick="return confirm(\'This product is added in some Users cart, are you sure you want to update his status?\');';
                    }else{
                        $onclick='onclick="return confirm(\'Are you sure you want to delete this item?\');';
                        $onclick_status='onclick="return confirm(\'Are you sure you want to update his status?\');';
                    }
                    return '<a href="'.route('view-product',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('status-update',$modal->id).'" '.$onclick_status.'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
                <a href="'.route('toggle-status',['model'=>'Product','column'=>'is_featured','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Featured"><i class="fas fa-award"></i></a>&nbsp
                <a href="'.route('edit-product',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-product',$modal->id).'" '.$onclick.'" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  '; })
                ->addIndexColumn()
                ->rawColumns(['image','subCategory', 'action'])->make(true);
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('filter-products');
        }
    }
    /**
       * @method:    findUniqueName
       * @purpose:   check unique name of product
       * @param Request $request
       * @return json response
    */  
    public function findUniqueName(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        if($request->prev_prod_id!=0){
            $product=Product::find($request->prev_prod_id);
            if($product->name==$request->product_name){
                return response()->json(['status'=>0,'message'=>"Previous Product."], 200);
            }
        }
        $product_name= Product::whereName($request->product_name)->get();
        if(count($product_name)>0){
            return response()->json(['status'=>'error','message'=>'Product name already exist.']);
        }else{
            return response()->json(['status'=>'success']);
        }        
    }
    /**
       * @method:    productStockList
       * @purpose:   product stock list representation
       * @param null
       * @return product list with his stock representation
    */
    public function productStockList()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        # get all the products
        $all_products = Product::select('id','name', 'sku', 'status')->orderBy('id', 'DESC')->get();
        $lowestStock=500;
        $mediumStock=1000;
        return view('admin.Stock.list', compact('all_products','lowestStock','mediumStock'));
    }
    /**
       * @method:    addProductStock
       * @purpose:   add product stock
       * @param Request $request, $id
       * @return list view of stock
    */
    public function addProductStock(Request $request, $id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        if ($request->isMethod('GET')) {
            $product = Product::where('id', $id)->first();
            $sizes = ProductSize::where('product_id', $id)->with('productStock')->get();
            return view('admin.Stock.view', compact('product', 'sizes'));
        }
        $stocks = $request->except('_token');
        $product = Product::where('id', $id)->first();
        if ($product) {
            $values = array();
            ProductStock::where('product_id',$id)->delete();
            $curr_time = Carbon::now();
            foreach ($stocks as $size_id => $stock_value) {
                $temp = [
                    'product_id' => $product->id,
                    'product_size_id' => $size_id,
                    'stock' => $stock_value,
                    'created_at' => $curr_time,
                    'updated_at' => $curr_time
                ];
                array_push($values, $temp);
            }
            ProductStock::insert($values);
            flash('Stock updated successfully')->success();
            return redirect()->back();
        }
        flash('Invalid Product')->error();
        return redirect()->back();
    }
    /**
       * @method:    trash_product
       * @purpose:   trash product view
       * @param null
       * @return Trash product list view
    */
    public function trash_product(){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $trash_product=Product::onlyTrashed()->get();    
        return view('admin.Product.all_trashed_product',compact('trash_product'));
    }
    /**
       * @method:    trash_productData
       * @purpose:   trash product view data
       * @param null
       * @return Trash product list view with data
    */
    public function trash_productData()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $data = Product::with('product_image','subCategories.subcategories')->onlyTrashed();
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
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                $featureIcon = ($modal->is_featured == 0) ? '<i class="fas fa-award"></i>' : '<i class="fas fa-award text-success"></i>';
                $cart_product_exist=UserCart::where([['product_id',$modal->id]])->get()->count();
                $onclick='onclick="return confirm(\'Are you sure you want to delete this item?\');';
                return '
                <a href="'.route('restore-single',$modal->id).'" data-toggle="tooltip" title="restore"><i class="fas fa-window-maximize"></i></a>&nbsp
                <a href="'.route('delete-trash-product',$modal->id).'" '.$onclick.'" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->rawColumns(['prpductCheckbox','image', 'action'])->make(true);
//            ->toJson();
    }
    /**
       * @method:    restore products
       * @purpose:   trash products restore 
       * @param null
       * @return product list with restored product data
    */
    public function restore_trash_product(){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $product= Product::onlyTrashed()->restore();
        if(!empty($product)){
            flash('Trash product restore successfully.')->success();
            return redirect()->route('product-list'); 
        }else{
           flash('Trash product not found for restore.')->error();
           return redirect()->back();
        }
    }
    /**
       * @method:    restore_single_product
       * @purpose:   single trash product restore 
       * @param $id
       * @return Trash product list view with data
    */
    public function restore_single_product($id){  
        $this->setNavigation(['menu-item-catalog','menu-item-products']);      
        $product= Product::onlyTrashed()->where(['id'=>$id])->restore();
        if(!empty($product)){
            flash('Trash product restore successfully.')->success();
            return redirect()->route('product-list');  
        }else{
            flash('Trash product not found for restore.')->error();
           return redirect()->back();
        }
    }
    /**
       * @method:    force_delete_product
       * @purpose:   permnanetly delete product  
       * @param $id
       * @return Trash product list view with remaning data
    */
    public function force_delete_product($id){
        $this->setNavigation(['menu-item-catalog','menu-item-products']);
        $product= Product::onlyTrashed()->where(['id'=>$id]);
        $product->forceDelete();
        flash('Product deleted successfully.')->success();
        return redirect()->back();
    }
    /**
       * @method:    allTrashProductDelete
       * @purpose:   permnanetly delete all trash products  
       * @param $request
       * @return product list
    */
    public function allTrashProductDelete(Request $request)
    {
        foreach ($request->productSelected as $id) {
            $this->setNavigation(['menu-item-catalog','menu-item-products']);
            UserCart::where([['product_id',$id]])->delete();
            CouponsProduct::where([['products_id',$id]])->delete();
            ProductCategorySubCategory::where([['product_id',$id]])->delete();
            ProductSetPrice::where([['product_id',$id]])->delete();
            ProductSet::where([['product_id',$id]])->delete();
            ProductStock::where([['product_id',$id]])->delete();
            ProductSize::where([['product_id',$id]])->delete();
            ProductHighlight::where([['product_id',$id]])->delete();
            ProductImage::where([['product_id',$id]])->delete();
            RelatedProduct::where([['product_id',$id]])->delete();
            RelatedProduct::where('related_product_id',$id)->delete();
            ProductTag::where([['product_id',$id]])->delete();        
            Product::onlyTrashed()->where('id',$id)->forceDelete();
        }
        flash('Product deleted successfully.')->success();
        return response()->json(['success'=>'Selected Product deleted successfully.'], 200);        
    }
    /**
       * @method:    product_status_update
       * @purpose:   product status update  
       * @param $id
       * @return product list with updated status
    */
    public function product_status_update($id){
        $product=Product::where('id',$id)->get()->first();
        if($product->status=='1'){
            UserCart::where('product_id',$id)->delete();
            Product::where('id',$id)->update(['status'=>0]);
            flash('Status update successfully.')->success();
            return redirect()->back();            
        }else{
            Product::where('id',$id)->update(['status'=>1]);
            flash('Status update successfully.')->success();
            return redirect()->back();
        }
    }
}