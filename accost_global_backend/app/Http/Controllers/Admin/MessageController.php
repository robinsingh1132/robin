<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MessageController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  /**
     * @method:    listMessages
     * @purpose:   list view of Messages
     * @param null
     * @return Message list blade
  */
  public function listMessages(){
    $this->setNavigation(['menu-item-message']);
    try{
        $products = Product::where('status',1)->get();
        return view('admin.Message.list',compact('products'));
    }catch(\Exception $e){
        flash($e->getMessage())->error();
        return redirect()->route('list-messages');
    }
  }
  /**
     * @method:    messageData
     * @purpose:   message data
     * @param null
     * @return json response: message list datatables
  */
  public function messageData()
  {
      $this->setNavigation(['menu-item-message']);
      $data = Message::where([['sender_id','!=','1'],['title','!=','']])->with('product','user','user.user_profile')->get();
      $data = $data->map(function($not, $key){
        $not->diffForHumans=$not->created_at->timezone(env('DISPLAY_TIMEZONE'))->format('d/m/Y h:i A');
        return $not;
      });
      return datatables()->collection($data)
      ->addColumn('product', function ($data){
          if(!empty($data->product)){
             return $data->product->name;
          }else{
              return '';
          }
      })
      ->addColumn('sender', function ($data){
          if(!empty($data->user->user_profile)){
             return $data->user->user_profile->first_name;
          }else{
              return '';
          }
      })
      ->addColumn('product', function ($data){
          if(!empty($data->product)){
             return $data->product->name;
          }else{
              return '';
          }
      })
      /*->addColumn('weblink', function ($data){
          if(!empty($data->product)){
             return $data->product->name.'@#@'. $data->product->id;
          }else{
              return '';
          }
      })*/
    ->addColumn('action', function ($modal) {
        $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
        return 
        '<a href="'.url('admin/messages/conversation/' . $modal->sender_id . '/' .$modal->product_id).'" data-toggle="tooltip" title="Send Message"><i class="fas fa-comment-alt text-primary"></i></a>&nbsp
        <a href="'.route('delete-message',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this message?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
          '; })
    ->addIndexColumn()
    ->toJson();
  }
  /**
     * @method:    destroy
     * @purpose:   message destroy
     * @param null
     * @return json response: message list datatables
  */
  public function destroy($id)
  {
  	$this->setNavigation(['menu-item-message']);
      try{
          Message::where([['id',$id]])->delete();
          flash('Message delete successfully.')->success();
          return redirect()->back();
      }catch(\Exception $e){
          flash($e->getMessage())->error();
          return redirect()->route('list-messages');
      }
  }
  /**
     * @method:    View
     * @purpose:   view of Messages
     * @param null
     * @return view blade
  */
  public function view($id)
  {
  	$this->setNavigation(['menu-item-message']);
    try{
        $message = Message::whereId($id)->with('product','user','user.user_profile')->first();
        return view('admin.Message.detail',compact('message'));
    }catch(\Exception $e){
        flash($e->getMessage())->error();
        return redirect()->route('list-messages');
    }
  }
  /**
     * @method:    FilterMessages
     * @purpose:   filter list of Messages
     * @param null
     * @return filterd Message list blade
  */
  public function filterMessages(Request $request){
    $this->setNavigation(['menu-item-message']);
    try{
      $product_id=$request->product_id;
      $to_date=$request->to_date;
      $from_date=$request->from_date;
      $product_name=Product::whereId($product_id)->first('name');
      $products = Product::where('status',1)->get();
      return view('admin.Message.filter_results',compact('product_name','product_id','to_date','from_date','products'));
    }catch(\Exception $e){
      flash($e->getMessage())->error();
      return redirect()->route('list-messages');
    }
  }
  /**
     * @method:    filter result data
     * @purpose:   filter message result
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
      if(!empty($request->product_id) && !empty($toDate) && !empty($fromDate)){
        $data=Message::where([['product_id', $request->product_id],['sender_id','!=','1'],['title','!=','']])->whereBetween('created_at',array($fromDate,$toDate))->with('product','user','user.user_profile')->get();
      }
      elseif(!empty($toDate)&&!empty($fromDate)){
        $data=Message::whereBetween('created_at',array($fromDate,$toDate))->with('product','user','user.user_profile')->get();
      }elseif(!empty($request->product_id)){
        $data=Message::where([['product_id', $request->product_id],['sender_id','!=','1'],['title','!=','']])->with('product','user','user.user_profile')->get();
      }else{
        $data=Message::where([['sender_id','!=','1'],['title','!=','']])->with('product','user','user.user_profile')->get();
      }
      $data = $data->map(function($not, $key){
        $not->diffForHumans=date('d/m/Y h:i A',strtotime($not->created_at));
        return $not;
      });
      return datatables()->collection($data)
      ->addColumn('product', function ($data){
          if(!empty($data->product)){
            return $data->product->name;
          }else{
            return '';
          }
      })
      ->addColumn('sender', function ($data){
          if(!empty($data->user->user_profile)){
             return $data->user->user_profile->first_name;
          }else{
              return '';
          }
      })
      ->addColumn('product', function ($data){
          if(!empty($data->product)){
             return $data->product->name;
          }else{
              return '';
          }
      })
      /*->addColumn('weblink', function ($data){
          if(!empty($data->product)){
             return $data->product->name.'@#@'. $data->product->id;
          }else{
              return '';
          }
      })*/
    ->addColumn('action', function ($modal) {
        $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
        return 
        '<a href="'.url('admin/messages/conversation/' . $modal->sender_id . '/' .$modal->product_id).'" data-toggle="tooltip" title="Send Message"><i class="fas fa-comment-alt text-primary"></i></a>&nbsp
        <a href="'.route('delete-message',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this message?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
          '; })
    ->addIndexColumn()->toJson();
    }catch(\Exception $e){
      flash($e->getMessage())->error();
      return redirect()->route('list-messages');
    }
  }
  /**
     * @method:    sendMessage
     * @purpose:   send Message to customer
     * @param null
     * @return Message list blade
  */
  public function sendMessage(Request $request){
    $this->setNavigation(['menu-item-message']);
    $admin = auth()->user();
    $last_msg=Message::find($request->last_msg_id);
    $reply_data=[
      'sender_id'         =>  $last_msg->receiver_id,
      'receiver_id'       =>  $last_msg->sender_id,
      'receiver_role_id'  =>  2,
      'product_id'        =>  $last_msg->product_id,
      'coupon_code'       =>  $request->coupon_code,
      'message'           =>  $request->message,
      'is_read'           =>  0,
    ];
    $message=Message::create($reply_data);
    try{
      $this->validate($request,[
        'message'=>'required',
      ]);
      $msg=Message::whereId($request->last_msg_id)->with('product','user','user.user_profile')->first();
      $email=$msg->user->email;
      $subject="Message Reply from Admin.";      
      if($request->coupon_code!=''){
        $coupon_code=$request->coupon_code;
      }else{
        $coupon_code="No coupon available.";
      }
      $data['admin_name']=$admin->user_profile->first_name;
      $data['customer_name']=$msg->user->user_profile->first_name;
      $data['msg']=$request->message;
      $data['coupon_code']=$coupon_code;
      $data['product_name']=$last_msg->product->name;
      /*$data['coupons']=$product[0]->couponsProduct;*/
      Mail::send('admin.Message.sendmail_template', $data, function($message)use ($email,$subject){
        $message->to($email, 'Accost Global')->subject
              ($subject);
        $message->from('noreply@accostglobal.com', 'Accost Global');    
      });
      $message_reply=Message::whereId($message->id)->with('product','user','user.user_profile')->first();
      $customer_name=$data['customer_name'];
      return response()->json(['status'=>'success','message'=>'Message send succesfully.','msg_reply'=>$message_reply,'customer_name'=>$customer_name]);
    }catch(\Exception $e){
      flash($e->getMessage())->error();
      return redirect()->route('list-messages');
    }
  }
  /**
     * @method:    getCoupon
     * @purpose:   get coupon for product
     * @param null
     * @return mail popup blade
  */
  public function getCoupon(Request $request){
    $msg=Message::whereId($request->msg_id)->with('product','user','user.user_profile')->first();
    $product=Product::where('id',$msg->product_id)->with('couponsProduct','couponsProduct.coupon')->get();
    $coupons=$product[0]->couponsProduct;
    return response()->json(['status'=>'success','coupons'=>$coupons,'product'=>$product]);
  }
  public function get_msg_all_notification(){
    $this->setNavigation(['menu-item-message']);
    $msg_notification_all=Message::where([['receiver_role_id',1],['receiver_id',1]])->with('user','user.user_profile')->orderBy('id','desc')->paginate(5);
    //dd($msg_notification_all);
    return view('admin.Message.all_msg_notification',compact('msg_notification_all'));
  }
  public function get_conversation($sender_id,$product_id){
    $this->setNavigation(['menu-item-message']);
    $admin = auth()->user();
    $customer_msg_details=Message::where([['sender_id',$sender_id],['product_id',$product_id]])->with('product','product.product_image','user','user.user_profile')->latest()->get();
    $product=Product::where('id',$product_id)->with('couponsProduct','couponsProduct.coupon')->get();
    if($product->count()==0){
      flash('Please check customer message contain invalid product id.')->error();
      return redirect()->back();
    }

    $coupons = Coupon::where('status','=', 1)
        ->whereRaw('date(start_date) < now() AND date(end_date) > now()')->get();
    #$coupons=$product[0]->couponsProduct;
    $conversation_messages=Message::where([['sender_id',$sender_id],['product_id',$product_id]])->orWhere([['sender_id',$admin->id],['product_id',$product_id],['receiver_id',$sender_id]])->with('product','user','user.user_profile')->orderBy('created_at','ASC')->get();
    return view('admin.Message.conversation',compact('conversation_messages','coupons','customer_msg_details'));
  }
  public function clear_all_notification(){
    $this->setNavigation(['menu-item-message']);
    Message::where([['is_read',0],['receiver_role_id',1],['receiver_id',1]])->update(['is_read'=>1]);
    return redirect()->back();
  }
  public function notification_status(Request $request)
  {
    $this->setNavigation(['menu-item-message']);
    $msg_notification=Message::where([['id',$request->msg_id],['sender_id',$request->sender_id],['product_id',$request->product_id]])->with('user','user.user_profile')->get()->first();
    //dd($msg_notification->is_read);
    if($msg_notification->is_read==1){
      $url=url("admin/messages/conversation/$request->sender_id/$request->product_id");
    }else{
      Message::where('id',$request->msg_id)->update(['is_read'=>1]);
      $url=url("admin/messages/conversation/$request->sender_id/$request->product_id");
    }
    return response()->json(['status'=>'success','url'=>$url]);
  }
  public function notification_automation(){
    $auto_msg_notification=Message::where([['is_read',0],['receiver_role_id',1],['receiver_id',1]])->with('user','user.user_profile')->orderBy('id','desc')->get();
    $auto_msg_notification_count=$auto_msg_notification->count();
    $auto_msg_notification=$auto_msg_notification->take(5);
    $auto_msg_notification = $auto_msg_notification->map(function($not, $key){
    $not->diffForHumans=$not->created_at->diffForHumans();
    return $not;
    });
    return response()->json(['status'=>'success','auto_msg_notification_count'=>$auto_msg_notification_count,'auto_msg_notification'=>$auto_msg_notification]);
  }
}