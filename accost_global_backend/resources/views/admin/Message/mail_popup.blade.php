{{--Modal mail popup start--}}
<div class="modal fade" id="sendMessage" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="send-message" method="POST" action="{{ route('send-message') }}">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Send Messages</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="message_id" class="hidden_id" value="">
                    <input type="hidden" name="product_name" class="product_name" value="">
                    <div class="form-group form-show-validation">
                        <div class="select2-input select2-warning">
                            <span>Title</span>
                            <input type="text" class="form-control" name="title" placeholder="title" value="Message Reply from Admin." readonly="true">
                        </div>
                    </div>
                    <div class="form-group form-show-validation coupon_code_html">
                        <div class="select2-input select2-warning">
                            <span>Product Coupon Code</span>
                            <select id="coupon" name="coupon_code" class="form-control">
                                <option value="">Select product coupon code</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-show-validation">
                        <span>Message</span>
                        <textarea class="form-control" name="message" row="4" coloumn="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="btn-label"><i class="fas fa-times"></i></span>Close</button>
                        <button type="submit" class="btn btn-xs btn-primary text-white msg_form" ><span class="btn-label"><i class="fas fa-envelope"></i></span>Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>