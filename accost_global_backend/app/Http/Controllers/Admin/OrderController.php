<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Order;
use App\OrderDetail;
use App\PaymentDetail;
use App\UserAddress;


class OrderController extends Controller
{
    public function listOrder()
	{
		$this->setNavigation(['menu-item-order']);
		return view('admin.Orders.list');
	}
    public function orderData()
    {        
    	$this->setNavigation(['menu-item-order']);
    	$data=Order::all();
    	return datatables()->Collection($data)
        ->addColumn('action', function ($modal) {                
            return '<a href="'.route('edit-order',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
            <a href="'.route('delete-order',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this order?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
              '; })
        ->addColumn('order_details', function ($modal) { 
            return '<a href="'.route('order-items-details',$modal->id).'" data-toggle="tooltip" title="Items details"><i class="fas fa-shopping-bag"></i></a>&nbsp
            <a href="'.route('order-address-details',$modal->id).'" data-toggle="tooltip" title="User address details"><i class="fas fa-address-card"></i></a>&nbsp
            <a href="javascript:void(0)" data-toggle="tooltip" title="Shipping details"><i class="fas fa-shipping-fast"></i></a>&nbsp
            <a href="'.route('order-payment-details',$modal->id).'" data-toggle="tooltip" title="Payment details"><i class="fab fa-cc-mastercard"></i></a>
              '; })        
        ->addIndexColumn()
        ->toJson();
    }
    public function export()
    {
        $this->setNavigation(['menu-item-order']);
        try{
            return Excel::download(new OrdersExport, 'orders.xlsx');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function order_details(Request $request,$id)
    {
        $route_name=$request->route()->getName();
        $this->setNavigation(['menu-item-order']);
        try{
            $order=Order::find($id);
            $order_address_details=UserAddress::where([['user_id',$order->user_id],['id',$order->user_multi_address_id]])->get();
            $order_items_details=OrderDetail::where([['user_id',$order->user_id],['invoice_id',$order->invoice_id]])->get();
            $order_payment_details=PaymentDetail::where([['user_id',$order->user_id],['order_id',$order->id]])->get();
            return view('admin.Orders.order_details',compact('order','order_address_details','order_items_details','order_payment_details','route_name'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    public function edit(Request $request,$id)
    {
        $this->setNavigation(['menu-item-order']);
        $route_name=$request->route()->getName();
        //dd($route_name);
        $order=Order::find($id)->first();
        if($route_name=="edit-payment-status"){
            $payment=PaymentDetail::where([['user_id',$order->user_id],['order_id',$order->id]])->get()->first();
            return view('admin.Orders.edit',compact('payment','route_name'));
        }else{
            $order=$order;
            return view('admin.Orders.edit',compact('order','route_name'));
        }
    }
    public function update(Request $request,$id)
    {
        $this->setNavigation(['menu-item-order']);
        $route_name=$request->route()->getName();
        if($route_name=="update-payment-status"){
            PaymentDetail::where('order_id',$id)->update(array('payment_status' => $request->payment_status));
            return redirect()->route('order-payment-details',$id);
        }else{
            Order::where('id', $id)->update(array('status' => $request->status,'remark'=>$request->remark));
            return view('admin.Orders.list');
        }        
    }
}