<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Accost Global</title>
	</head>
	<body>
	  <div style="width:100%; margin:auto; background:#f5f5f5;text-align: center;">
	    <div style="font-size:15px;font-family:Arial, Helvetica, sans-serif; color:#555;width:auto;margin: 0 auto;border: solid 1px #e4e4e4; display: inline-block; background:#fff;">
	      <table width="600px" style="border: solid 1px #e4e4e4; margin: 0 auto; max-width:600px;font-family:Arial, Helvetica, sans-serif;" align="center" cellpadding="0" cellspacing="0">
	        <tr>
	            <td height="70" align="center" style="    border-top: solid 3px #489fff; text-align: left; padding: 0px 21px; background-color: #fff; border-bottom: solid 2px #cbccce;"><a href="#" style="font-size: 24px; font-weight: bold; color: #489fff; text-decoration: none;">ACCOST GLOBAL</a>
	            </td>
	        </tr>
	          <tr>
	              <td align="center" valign="top">
	                  <table style="width:95%;margin:10px 0 38px;" width="95%" border="0" cellspacing="0" cellpadding="0">
	                    <tr>
	                        <td style="text-align:left;padding-top:20px;padding-bottom:30px;">
	                            <strong> Hello {{ucfirst($customer_name)}}</strong>,<p>You have received a reply from <strong>{{ucfirst($admin_name)}}</strong>.</p>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td style="text-align:left;padding: 14px 10px;border: solid 1px #ddd;background-color: #f1f4f5;font-style: italic;box-shadow: 0px 3px 7px rgba(0,0,0,.09)">
	                            <div style="display:block;font-style: italic;">
	                            	<p><strong>Product name : </strong>{{$product_name}} </p>
									<p><strong>Product Coupon Code : </strong>{{$coupon_code}} </p>
									<p><strong>Message : </strong>{!!$msg!!}</p>
								</div>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td style="text-align:left;padding-top:20px;padding-bottom:30px;">
	                            <strong>Thanks,</strong><br>
								{{ucfirst($admin_name)}}
	                        </td>
	                    </tr>
	                  </table>
	              </td>
	          </tr>
	          <tr>
	            <td style="padding: 10px 0; background-color: #f8f8f8;text-align:center;color: #9b9b9b;"><a href=""  style="font-size: 12px;  color: #444; text-decoration: none;">ACCOST GLOBAL</a>
	            </td>
	        </tr>
	      </table>
	    </div>
	  </div>
	</body>
</html>