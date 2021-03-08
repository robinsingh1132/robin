<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Message;

class Controller extends BaseController
{
	public function __construct(){
		$arr_navigation = array();
		$msg_notification1=Message::where([['is_read',0],['receiver_role_id',1],['receiver_id',1]])->with('user','user.user_profile')->orderBy('id','desc')->get();
		$msg_notification_count1=$msg_notification1->count();
		View::share ( 'msg_notification1', $msg_notification1 );
		View::share ( 'msg_notification_count1', $msg_notification_count1 );
	}
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*admin side bar expanded related menu and submenu*/
    public function setNavigation($arr_navigation){
    	$this->arr_navigation = $arr_navigation;
    	view()->share('arr_navigation', $this->arr_navigation);
    }
    
}
