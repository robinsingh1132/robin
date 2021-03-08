<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\ProductSuperCategory;
use App\Coupon;
use App\CouponsCategory;
use App\CouponsProduct;
use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Lib\Validators\DiscountCouponValidator;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
       * @method:    newDiscountCoupons
       * @purpose:   add coupon
       * @param  null
       * @return add coupon blade
    */
    public function newDiscountCoupons(){
        $this->setNavigation(['menu-item-coupon']);
        try{
            $coupon_form_action=config("app.asset_url").'/admin/discount-coupons/save';
            $super_categories =ProductSuperCategory::all();
            return view('admin.DiscountCoupon.new',compact('coupon_form_action','super_categories'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-coupons');
        }
    }
    /**
       * @method:    saveDiscountCoupons
       * @purpose:   Request $request
       * @param Request $request
       * @return null
    */
    public function saveDiscountCoupons(Request $request){  
        $this->setNavigation(['menu-item-coupon']);
        $this->validate($request, DiscountCouponValidator::SAVE_COUPON);
        try{
            $requestData = $request->all();
            $start=str_ireplace('/', '-', $requestData['start_date']);
            $start_date= date('Y-m-d', strtotime($start));
            if($requestData['duration']=='forever'){
                $end_date=null;
            }else{
                $end=str_ireplace('/', '-', $requestData['end_date']);
                $end_date= date('Y-m-d', strtotime($end));
            }
            $couponData = [
                'coupon_type'         =>  $requestData['coupon_type'],
                'coupon_available_on' =>  $requestData['coupon_available_on'],
                'name'                =>  $requestData['name'],
                'coupon_code'         =>  $requestData['coupon_code'],
                'coupon_description'  =>  $requestData['coupon_description'],
                'value'               =>  $requestData['value'],
                'duration'            =>  $requestData['duration'],
                'minimum_quantity'    =>  $requestData['minimum_quantity'],
                'maximum_quantity'    =>  $requestData['maximum_quantity'],
                'maximum_redemption'  =>  $requestData['maximum_redemption'],
                'start_date'          => $start_date,
                'end_date'            => $end_date,
                'status'              => 1,
            ];
            $couponId=Coupon::insertGetId($couponData);
            $url=route('edit-coupons',$couponId).'?nextTab=1'.'&saveTab=save';
            return redirect($url);
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    listDiscountCoupons
       * @purpose:   list view of coupon
       * @param null
       * @return coupon list blade
    */
    public function listDiscountCoupons(){       
        $this->setNavigation(['menu-item-coupon']);
        try{
            $coupons = Coupon::all();
            return view('admin.DiscountCoupon.list',compact('coupons'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-coupons');
        }
    }
    /**
       * @method:    couponData
       * @purpose:   coupon data
       * @param null
       * @return json response: coupon list datatables
    */
    public function couponData()
    {
        $this->setNavigation(['menu-item-coupon']);
        $data = Coupon::all();
        return datatables()->Collection($data)
            ->addColumn('action', function ($modal) {
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                if($modal->coupon_available_on!==0){
                    $route=route('apply-coupons',$modal->id);
                }else{
                    $route="";
                }
                return '<a href="'.route('view-coupons',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('toggle-status',['model'=>'Coupon','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp                
                <a href="'.route('edit-coupons',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp                
                <a href="'.route('delete-coupons',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this dealer?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->toJson();
    }
    /**
       * @method:    editDiscountCoupons
       * @purpose:   edit discount coupon
       * @param Request $request,$id
       * @return edit coupon blade
    */
    public function editDiscountCoupons(Request $request,$id){

        $this->setNavigation(['menu-item-coupon']);
        try{
            $coupon_form_action=config("app.asset_url").'/admin/discount-coupons/update/'.$id;
            $coupon = Coupon::whereId($id)->first();
            $start=str_ireplace('-', '/', $coupon->start_date);
            $start_date= date('m/d/Y', strtotime($start));
            $end=str_ireplace('-', '/', $coupon->end_date);
            $end_date= date('m/d/Y', strtotime($end));
            $superCatArr=$this->categoryTreeStructure($id);
            $nextTab=!empty($request->nextTab)?1:0;
            $saveTab=!empty($request->saveTab)?'save':'';         
            return view('admin.DiscountCoupon.edit',compact('coupon_form_action','coupon','superCatArr','nextTab','saveTab','start_date','end_date'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-coupons');
        }
    }
    /**
       * @method:    updateDiscountCoupons
       * @purpose:   update coupon
       * @param Request $request, $id
       * @return null
    */
    public function updateDiscountCoupons(Request $request, $id){
        $this->setNavigation(['menu-item-coupon']);
        $this->validate($request, DiscountCouponValidator::UPDATE_COUPON);
        $requestData = $request->all();
        $start=str_ireplace('/', '-', $requestData['start_date']);
        $start_date= date('Y-m-d', strtotime($start));        
        if($requestData['duration']=='forever'){
            $end_date=null;
        }else{
            $end=str_ireplace('/', '-', $requestData['end_date']);
            $end_date= date('Y-m-d', strtotime($end));
        }
        $coupon=Coupon::whereId($id)->get()->first();
        if($request->coupon_available_on==1){            
            CouponsProduct::where(['coupons_id'=>$id])->delete();
        }
        if($request->coupon_available_on==2){
            CouponsCategory::where(['coupon_id'=>$id])->delete();
        }
        if($request->coupon_available_on==0){
            CouponsCategory::where(['coupon_id'=>$id])->delete();
            CouponsProduct::where(['coupons_id'=>$id])->delete(); 
        }         
        $coupon_name=Coupon::where('id','!=',$id)->where('name','=',$request->name)->first();
        $coupon_code=Coupon::where('id','!=',$id)->where('coupon_code','=',$request->coupon_code)->first();
        if(!empty($coupon_name)){
            flash('Coupon Name already exist.Please create it to be unique.')->error();
            return redirect()->back();
        }
        if(!empty($coupon_code)){
            flash('Coupon Code already exist.Please create it to be unique.')->error();
            return redirect()->back();
        }
        try{            
            $couponData = [
                'coupon_type'         =>  $requestData['coupon_type'],
                'coupon_available_on' =>  $requestData['coupon_available_on'],
                'name'                =>  $requestData['name'],
                'coupon_code'         =>  $requestData['coupon_code'],
                'coupon_description'  =>  $requestData['coupon_description'],
                'value'               =>  $requestData['value'],
                'duration'            =>  $requestData['duration'],
                'minimum_quantity'    =>  $requestData['minimum_quantity'],
                'maximum_quantity'    =>  $requestData['maximum_quantity'],
                'maximum_redemption'  =>  $requestData['maximum_redemption'],
                'start_date'          => $start_date,
                'end_date'            => $end_date,
            ];
            Coupon::whereId($id)->update($couponData);
            $url=route('edit-coupons',$id).'?nextTab=1';
            return redirect($url);            
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    viewDiscountCoupons
       * @purpose:   view coupon
       * @param $id
       * @return coupon detail blade
    */
    public function viewDiscountCoupons($id){
        $this->setNavigation(['menu-item-coupon']);
        try{
            $coupon_form_action=config("app.asset_url").'/admin/discount-coupons/update/'.$id;
            $coupon = Coupon::whereId($id)->first();
            $superCatArr=$this->categoryTreeStructure($id);
            //dd($superCatArr);
            $onlyView=1;
            return view('admin.DiscountCoupon.detail',compact('coupon','superCatArr','coupon_form_action','onlyView'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-coupons');
        }
    }     
    /**
       * @method:    deleteDiscountCoupons
       * @purpose:   delete coupon
       * @param $id
       * @return null
    */
    public function deleteDiscountCoupons($id){
        $this->setNavigation(['menu-item-coupon']);
        try{
            CouponsProduct::where([['coupons_id',$id]])->delete();
            CouponsCategory::where([['coupon_id',$id]])->delete();
            $coupon = Coupon::whereId($id)->delete();            
            if($coupon){
                flash('Discount coupon deleted successfully.')->success();
                return redirect()->back();
            }else{
                flash('There is something wrong.')->error();
                return redirect()->back();
            }
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-coupons');
        }
    } 
    /*apply coupon module for coupon */
    /**
       * @method:    ApplyCoupons
       * @purpose:   Apply coupon
       * @param $id
       * @return apply coupon blade
    */
    public function ApplyCoupons($id){
        $this->setNavigation(['menu-item-coupon']);
        try{
            $coupon_id=$id;
            $coupon = Coupon::whereId($id)->first(); 
            $superCatArr=$this->categoryTreeStructure($coupon_id);
            return view('admin.DiscountCoupon.new',compact('coupon_id','coupon','superCatArr'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('apply-coupons',$coupon_id);
        }
    }
    /**
       * @method:    product_list
       * @purpose:   get product list
       * @param $coupon_id
       * @return json response : product list data
    */          
    public function product_list($coupon_id)
    {
        if($_GET['state']==1){
            $state='disabled="true"';
        }else{
            $state='';
        }
        $this->setNavigation(['menu-item-coupon']);
        $coupon_prod = CouponsProduct::where([['coupons_id',$coupon_id],['status',1]])->pluck('products_id')->toArray();
        $data=Product::where('status',1)->latest();             
        return datatables()->eloquent($data)
            ->addColumn('action', function ($modal) use ($coupon_prod,$state) {
                if(in_array($modal->id, $coupon_prod)){
                    $url=url('/admin/img/small_loader.gif');
                    return '<input type="checkbox" class="pro_list" name="id" value="'.$modal->id.'" checked="true"'.$state.'>
                        ';                    
                }else{
                    $url=url('/admin/img/small_loader.gif');
                    return '<input type="checkbox" class="pro_list" name="id" value="'.$modal->id.'"'.$state.'>
                    ';                    
                };                
            })->addIndexColumn()->toJson();
    }
    /**
       * @method:    add_products
       * @purpose:   apply coupon for product
       * @param Request $request
       * @return json response
    */
    public function add_products(Request $request){
        $this->setNavigation(['menu-item-coupon']);
        try{
            $check=CouponsProduct::where([['coupons_id',$request->coupon_id],['products_id',$request->product_id]])->get();
            if(count($check)>0){
                CouponsProduct::where([['coupons_id',$request->coupon_id],['products_id',$request->product_id]])->delete();
                return response()->json(['status'=>'success','message'=>'Coupon Successfully delete for this product.']);
            }else{
                $values = [
                        'coupons_id' => $request->coupon_id,
                        'products_id' =>$request->product_id,
                        'status' => 1
                    ];
                CouponsProduct::create($values);
                return response()->json(['status'=>'success','message'=>'Coupon Successfully apply for this product.']);
            }
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /**
       * @method:    save_coupon_categories
       * @purpose:   get tree view of categories
       * @param Request $request
       * @return json response: tree view of categories
    */
    public function save_coupon_categories(Request $request){
        $this->setNavigation(['menu-item-coupon']);
        if($request->type==1){
            $productCategories=ProductCategory::where([['product_super_category_id',$request->cat_id],['status',1]])->get();
            if(!empty($productCategories->count())){
                foreach ($productCategories as $prod_cat) {
                    if(!empty($prod_cat->id)){
                        $subCategories=ProductSubcategory::where([['product_category_id',$prod_cat->id],['status',1]])->get();
                        if(!empty($subCategories->count())){
                            foreach ($subCategories as $subCat) {
                            $this->save_coupon_category_data($request->coupon_id,$request->cat_id,$prod_cat->id,$subCat->id);
                            }
                        }else{
                            $this->save_coupon_category_data($request->coupon_id,$request->cat_id,$prod_cat->id); 
                        }
                    }                    
                }
            }else{
                $this->save_coupon_category_data($request->coupon_id,$request->cat_id); 
            }
        }elseif($request->type==2){
            $product_cat=ProductCategory::whereId($request->cat_id)->get()->first();
            $subCategories=ProductSubcategory::where([['product_category_id',$request->cat_id],['status',1]])->get();
            if(!empty($subCategories->count())){
                foreach ($subCategories as $subCat) {
                $this->save_coupon_category_data($request->coupon_id,$product_cat->product_super_category_id,$request->cat_id,$subCat->id);            
                }
            }else{
                $this->save_coupon_category_data($request->coupon_id,$product_cat->product_super_category_id,$request->cat_id);
            }
        }
        elseif($request->type==3){
            $product_subcat=ProductSubcategory::whereId($request->cat_id)->get()->first();
            $product_cat=ProductCategory::whereId($product_subcat->product_category_id)->get()->first();
            $this->save_coupon_category_data($request->coupon_id,$product_cat->product_super_category_id,$product_subcat->product_category_id,$request->cat_id);            
        }else{
            return response()->json(['status'=>'error','message'=>'something went wrong.']);
        }
        return response()->json(['status'=>'success','message'=>'Coupon add for selected category.', 'data'=>$this->categoryTreeStructure($request->coupon_id)]);
    }
    /**
       * @method:    save_coupon_category_data
       * @purpose:   save coupon apply for categories
       * @param $coupon_id,$super_category_id,$product_category_id=null,$subcat_id=null
       * @return null
    */
    protected function save_coupon_category_data($coupon_id,$super_category_id,$product_category_id=null,$subcat_id=null){
        $CouponCatData=[
            'coupon_id' => $coupon_id,
            'super_category_id' =>$super_category_id,
            'product_category_id' =>$product_category_id,
            'sub_category_id'=>$subcat_id,
            'status' => 1
        ];
        CouponsCategory::create($CouponCatData);
    }
    /**
       * @method:    delete_coupon_categories
       * @purpose:   remove coupon from categories
       * @param Request $request
       * @return json response
    */
    public function delete_coupon_categories(Request $request){
        $this->setNavigation(['menu-item-coupon']);
        if($request->type==1){                        
            $cat_type='super_category_id';
        }elseif($request->type==2){
            $cat_type='product_category_id';           
        }
        elseif($request->type==3){
            $cat_type='sub_category_id';            
        }else{
            return response()->json(['status'=>'error','message'=>'something went wrong.']);
        }
        CouponsCategory::where([['coupon_id',$request->coupon_id],[$cat_type,$request->cat_id]])->delete();
        return response()->json(['status'=>'success','message'=>'Coupon successfully removed for unchecked categories.','data'=>$this->categoryTreeStructure($request->coupon_id)]);            
    }
    /**
       * @method:    is_coupon_have_this_category
       * @purpose:   check coupon has category
       * @param $cat_id, $coupon_id, $type
       * @return coupon category exist or not
    */
    public function is_coupon_have_this_category($cat_id, $coupon_id, $type){
        $this->setNavigation(['menu-item-coupon']);
        if($type==1){                        
            $cat_type='super_category_id';
        }elseif($type==2){
            $cat_type='product_category_id';           
        }
        elseif($type==3){
            $cat_type='sub_category_id';            
        }else{
            return false;
        }
        return (CouponsCategory::where([['coupon_id',$coupon_id],[$cat_type,$cat_id]])->get()->count()>0);
    }
    /**
       * @method:    categoryTreeStructure
       * @purpose:   get super category,category,subcategory,data for tree structure
       * @param $coupon_id
       * @return supercategory array for draw tree structure
    */
    public function categoryTreeStructure($coupon_id){
        $superCats=ProductSuperCategory::where('status',1)->get();
        $superCatArr=array();
        $count=0;
        foreach ($superCats as $superCat) {
            $productCategory=$this->getProductCategory($superCat->id,$coupon_id);
            if(empty($productCategory)){
                continue;
            }
            $superCatArr[$count]['nodes']=$productCategory;
            $superCatArr[$count]['tags']= count($productCategory);
            $superCatArr[$count]['text']=$superCat->name;
            $superCatArr[$count]['href']='#superCat_'.$superCat->id;
            $superCatArr[$count]['state']['checked']=$this->is_coupon_have_this_category($superCat->id,$coupon_id,1);
            $superCatArr[$count]['state']['expanded']=$this->is_coupon_have_this_category($superCat->id,$coupon_id,1);
            $productCategory=$this->getProductCategory($superCat->id,$coupon_id);
            $count++;               
        }
        return $superCatArr;          
    }
    /**
       * @method:    getProductCategory
       * @purpose:   product category data
       * @param $superCatId,$coupon_id=''
       * @return product category array for draw tree structure
    */
    public function getProductCategory($superCatId,$coupon_id=''){
        $productCategories =ProductCategory::where([['product_super_category_id',$superCatId],['status',1]])->get();
        $productCatArr=array();
        $count=0;
        foreach ($productCategories as $productCategory) {
            $subCategory=$this->getSubCategory($productCategory->id,$coupon_id); 
            if(empty($subCategory)){
                continue; 
            } 
            $productCatArr[$count]['nodes']=$subCategory; 
            $productCatArr[$count]['tags']=count($subCategory);
            $productCatArr[$count]['text']=$productCategory->name;
            $productCatArr[$count]['href']='#productCat_'.$productCategory->id;
            $productCatArr[$count]['state']['checked']=$this->is_coupon_have_this_category($productCategory->id,$coupon_id,2);
            $productCatArr[$count]['state']['expanded']=$this->is_coupon_have_this_category($productCategory->id,$coupon_id,2);              
            $count++;
        }
        return $productCatArr;
    }
    /**
       * @method:    getSubCategory
       * @purpose:   get sub category data
       * @param $productCatId,$coupon_id=''
       * @return get subcat array for draw tree structure
    */
    public function getSubCategory($productCatId,$coupon_id=''){
        $ProductSubcategories=ProductSubcategory::where([['product_category_id',$productCatId],['status',1]])->get();
        $subCatArr=array();
        $count=0;
        foreach ($ProductSubcategories as $ProductSubcategory) {
            $subCatArr[$count]['text']=$ProductSubcategory->name;
            $subCatArr[$count]['href']='#subCat_'.$ProductSubcategory->id;
            $subCatArr[$count]['state']['checked']=$this->is_coupon_have_this_category($ProductSubcategory->id,$coupon_id,3);
            $count++;                      
        }
        return $subCatArr;
    }
    /**
       * @method:    findUniqueCouponName
       * @purpose:   check unique name of coupon
       * @param Request $request
       * @return json response
    */
    public function findUniqueCouponName(Request $request){
        $this->setNavigation(['menu-item-coupon']);
        if($request->prev_coupon_id!=0){
            $coupon=coupon::find($request->prev_coupon_id);
            if($coupon->name==$request->coupon_name){
                return response()->json(['status'=>0,'message'=>"Previous coupon name."], 200);
            }
        }
        $coupon_name= coupon::whereName($request->coupon_name)->get();
        if(count($coupon_name)>0){
            return response()->json(['status'=>1,'message'=>'Coupon name already exist.'],200);
        }else{
            return response()->json(['status'=>'0','message'=>'coupon name not exist.'],200);
        }
    }
    /**
       * @method:    findUniqueCouponCode
       * @purpose:   check unique coupon code
       * @param Request $request
       * @return json response
    */
    public function findUniqueCouponCode(Request $request){
        $this->setNavigation(['menu-item-coupon']);
        if($request->prev_coupon_id!=0){
            $coupon=coupon::find($request->prev_coupon_id);
            if($coupon->coupon_code==$request->coupon_code){
                return response()->json(['status'=>0,'message'=>"Previous coupon code."], 200);
            }
        }
        $coupon_code= coupon::where('coupon_code',$request->coupon_code)->get();
        if(count($coupon_code)>0){
            return response()->json(['status'=>1,'message'=>'Coupon code already exist.'],200);
        }else{
            return response()->json(['status'=>'0','message'=>'coupon code not exist.'],200);
        }
    }    
}