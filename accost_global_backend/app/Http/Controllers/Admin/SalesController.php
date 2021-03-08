<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Order;
use App\Product;
use App\OrderDetail;
use App\PaymentDetail;
use App\UserAddress;

class SalesController extends Controller
{
	public function listSales()
	{
		$this->setNavigation(['menu-item-sales']);
        $products = Product::where('status',1)->get();
		return view('admin.Sales.list',compact('products'));
	}
    public function salesData()
    {        
    	$this->setNavigation(['menu-item-sales']);
    	$data=Order::with('order_details','order_details.product')->where('status',1)->get();      
      $data = $data->map(function($not, $key){
        $not->order_date=date('d/m/Y',strtotime($not->order_date));
        $not->shipped_date=date('d/m/Y',strtotime($not->shipped_date));
        $not->sum_total_amount=Order::with('order_details','order_details.product')->where('status',1)->sum('total_amount');
        return $not;
      });
    	return datatables()->Collection($data)
        ->addColumn('product', function ($data){
            if(!empty($data->order_details->product)){
              return $data->order_details->product->name;
            }else 
            {
              return '';
            }
        })
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
    }
    public function export()
    {
        $this->setNavigation(['menu-item-sales']);
        try{
            return Excel::download(new SalesExport, 'Sales.xlsx');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function sales_details(Request $request,$id)
    {
        $route_name=$request->route()->getName();
        $this->setNavigation(['menu-item-sales']);
        try{
            $sales=Order::find($id);
            $sales_address_details=UserAddress::where([['user_id',$sales->user_id],['id',$sales->user_multi_address_id]])->get();
            $sales_items_details=OrderDetail::where([['user_id',$sales->user_id],['invoice_id',$sales->invoice_id]])->get();
            $sales_payment_details=PaymentDetail::where([['user_id',$sales->user_id],['order_id',$sales->id]])->get();
            return view('admin.Sales.sales_details',compact('sales','sales_address_details','sales_items_details','sales_payment_details','route_name'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    filterSales
       * @purpose:   filter Sales list
       * @param Request $request
       * @return Sales list blade
    */
    public function filterSales(Request $request){
    $this->setNavigation(['menu-item-message']);
    try{
      $product_id=$request->product_id;
      $to_date=$request->to_date;
      $from_date=$request->from_date;
      $product_name=Product::whereId($product_id)->first('name');
      $sales = Order::where('status',1)->get();
      return view('admin.Sales.filter-results',compact('product_name','product_id','to_date','from_date','sales'));
    }catch(\Exception $e){
      flash($e->getMessage())->error();
      return redirect()->route('list-sales');
    }
  }
  /**
     * @method:    filter result data
     * @purpose:   filter sales result
     * @param Request $request
     * @return filtered message list
  */
  public function filterResults(Request $request){
    //dd($request);
    $toDate=str_replace("/","-",$request->to_date);
    $from_date=str_replace("/","-",$request->from_date);
    $toDate=date('Y/m/d', strtotime($toDate));
    $fromDate=date('Y/m/d', strtotime($from_date));
    $this->setNavigation(['menu-item-message']);
    try{
      if(!empty($toDate)&&!empty($fromDate)){
        $data=Order::with('order_details','order_details.product')->where('status',1)->whereBetween('order_date',array($fromDate,$toDate))->get();
      }else{
        $data=Order::where('status',1)->with('order_details','order_details.product')->get();
      }
      $data = $data->map(function($not, $key){
        $not->order_date=date('d/m/Y',strtotime($not->order_date));
        $not->shipped_date=date('d/m/Y',strtotime($not->shipped_date));
        return $not;
      });
      return datatables()->Collection($data)
        ->addColumn('product', function ($data){
            if(!empty($data->order_details->product)){
              return $data->order_details->product->name;
            }else{
              return '';
            }
        })
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
    }catch(\Exception $e){
      flash($e->getMessage())->error();
      return redirect()->route('list-sales');
    }
  }
}