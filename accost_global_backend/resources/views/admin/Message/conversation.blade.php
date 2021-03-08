@extends('layouts.admin')
@section('style')
	<style>
		.div-coupon .input-group, .div-coupon .input-group-append {
			height: 33px;
		}
		.card-body .conversations {
			height: calc(100vh - 300px);
		}
		.conversations .messages-form {
			display: flex;
			width: 100%;
			align-items: center;
		}
		.messages-form .messages-form-control {
			-ms-flex-preferred-size: 0;
			flex-basis: 0;
			-webkit-box-flex: 1;
			-ms-flex-positive: 1;
			flex-grow: 1;
		}
	</style>
@endsection
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"> Messages</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="flaticon-home text-primary"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);">View & Reply Messages</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-edit text-success"></i> View All Notification
                                <span class="float-right"><a href="{{ route('list-messages') }}" class="text-info" data-toggle="tooltip" title="List View"><i class="fas fa-list-alt"></i></a></span>
                            </div>
                        </div> -->
                        <div class="card-body">
                            @include('flash::message')
                            <div class="conversations">
								<div class="message-header">
									<div class="message-title">
										<a class="btn btn-light" href="{{ route('list-messages') }}" title="back to message">
											<i class="fa fa-flip-horizontal fa-share"></i>
										</a>
										<div class="user ml-2">
											<div class="avatar">
												@php
													if(!empty($customer_msg_details[0]->user->user_profile->image)){
														$url = asset('/images/user/$customer_msg_details[0]->user->user_profile->image');
													}else{
														$url= asset('/images/user/no_user_img.png');
													}
												@endphp
												<img src="{{$url}}" alt="..." class="avatar-img rounded-circle border">
											</div>
											<div class="info-user ml-2">
												<span class="name">{{$customer_msg_details[0]->user->user_profile->first_name}}</span>
											</div>
											&nbsp&nbsp&nbsp&nbsp&nbsp
											
											<div class="info-user ml-2">
												<span class="product_name">Product Name: {{$customer_msg_details[0]->product->name}}</span>
											</div>
											&nbsp&nbsp&nbsp&nbsp&nbsp
											<div class="product_image">

												@php
												$name=$customer_msg_details[0]->product->product_image->image;
													if(!empty($customer_msg_details[0]->product->product_image->image)){
														$url_1= asset("/images/product/$name");
													}
												@endphp
												<img src="{{$url_1}}" alt="product_image" class="avatar-img rounded-circle border" style="height:50px;width:50px">
											</div>
										</div>
									</div>
								</div>
								<div class="conversations-body">
									<div class="conversations-content bg-white">
										@foreach($conversation_messages as $message)
										@if($message->sender_id!=1)
										<div class="message-content-wrapper">
											<div class="message message-in">
												<div class="avatar avatar-sm">
													<img src="{{$url}}" alt="..." class="avatar-img rounded-circle border">
												</div>
												<div class="message-body">
												<div class="message-content">
													<div class="name">{{$message->user->user_profile->first_name}}</div>
													@if(!empty($message->quantity))
													<div class="content">Product Units : {{$message->unit}}</div>
													<div class="content">Product Quantity : {{$message->quantity}}</div>
													<div class="content"><br></div>
													@endif
													<div class="content">{!! $message->message !!}</div>
												</div>
												{{--<div class="date">{{date('d/m/Y h:i A', strtotime($message->created_at, 'Asia/kolkata'))}}</div>--}}
												<div class="date">{{$message->created_at->timezone(env('DISPLAY_TIMEZONE'))->format('d/m/Y h:i A')}}</div>
											</div>
										</div>
										@else
											<div class="message-content-wrapper">
												<div class="message message-out">
													<div class="message-body">
														<div class="message-content">
															<div class="content">
																{!! $message->message !!} <br>
																@if(!empty($message->coupon_code))
																Product : {{$message->product->name}} <br> Coupon Code :  "{{$message->coupon_code}}" 
																@endif
															</div>
														</div>
														{{--<div class="date">{{date('d/m/Y h:i A', strtotime($message->created_at))}}</div>--}}
														<div class="date">{{$message->created_at->timezone('Asia/Kolkata')->format('d/m/Y h:i A')}}</div>
													</div>
												</div>
											</div>
										@endif
										@endforeach
									</div>
								</div>
							</div>
                        </div>
						<form id="send-message" class="conversations-content bg-white" method="POST" action="{{ route('send-message') }}">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
								<div class="messages-form">
									<!-- hidden data need to set -->
									<input type="hidden" id="last_msg_id" name="last_msg_id" value="{{$customer_msg_details[0]->id}}">
									<div class="messages-form-control">
										{{--<input type="text" name="message" placeholder="Type here" class="form-control input-pill input-solid message-input">--}}
										<textarea name="message" id="text-message" rows="3" style="width: 100%"></textarea>
									</div>
									<div class="messages-form-tool">
										<a href="#" class="attachment" title="Coupon" data-toggle="modal" data-target="#sendMessage">
											<i class="fas fa-tags"></i>
										</a>
									</div>
									<div class="messages-form-tool">
										<button type="submit" class="attachment text-info pointer" ><i class="far fa-paper-plane"></i></button>
									</div>
								</div>
							</form>
						<div class="modal fade" id="sendMessage" role="dialog" style="">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Coupon Code</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<p class="text-center text-success" id="success-copied"></p>
											@foreach($coupons as $coupon)
												<div class="div-coupon">
													<div class="input-group mb-1">
														<input type="text" class="form-control"  id="C{{$coupon->coupon_code}}" value="{{$coupon->coupon_code}}">
														<div class="input-group-append">
															<button class="input-group-text btn copyButton" data-clipboard-target="#C{{$coupon->coupon_code}}">copy</button>
														</div>
													</div>
													{{--<input type="text" readonly id="{{$coupon->coupon_code}}" value="{{$coupon->coupon_code}}">
													<button class="btn copyButton" data-clipboard-target="#{{$coupon->coupon_code}}"></button>--}}
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    @include('admin.Message.form_validate')
	<script>
		$(document).ready(function(){
			var clipboard = new ClipboardJS('.copyButton');
			clipboard.on('success', function(e) {
				$('#success-copied').html('copied!');
				setTimeout(function(){
					$('#success-copied').html('');
				}, 3000);
			});
		});
	</script>
@endsection