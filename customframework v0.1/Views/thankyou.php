
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from trybiogoldextracts.com/thankyou.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:54:23 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BioGold CBD</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->resourcePath; ?><?php echo $this->resourcePath; ?>images/favicon.ico">
<link href="<?php echo $this->resourcePath; ?>css/checkout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->resourcePath; ?>css/upsell.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&amp;family=Open+Sans&amp;display=swap" rel="stylesheet">

<script type="text/javascript" src="<?php echo $this->resourcePath; ?>js/jquery.min.js"></script>
<script type="text/javascript">
	function getDate(days) {      
		var monthNames = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");    
		var now = new Date();   
		now.setDate(now.getDate() + days);   
		var nowString =  monthNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear();   
		document.write(nowString); 
	}
	
	$(document).ready(function(){
		$("#orderConfirmContent").hide();
		$.ajax({
			type: 'post',
			url: 'queryOrder',
			data: {},
			success: function(responseData) {
			var tempData = JSON.parse(responseData);
				if(tempData.result == "success"){
					var currencySymbol = tempData.data.message.data[0].currencySymbol;
					var orderId = tempData.data.message.data[0].orderId;
					var subTotal = currencySymbol + " " + tempData.data.message.data[0].price;
					var shippingTotal = currencySymbol + " " + tempData.data.message.data[0].baseShipping;
					var grandTotal = currencySymbol + " " + tempData.data.message.data[0].totalAmount;
					var billingInformation = tempData.data.message.data[0].firstName + " " + tempData.data.message.data[0].lastName;
					var shippingInformation = tempData.data.message.data[0].shipFirstName + " " + tempData.data.message.data[0].shipLastName;
					var emailAddress = tempData.data.message.data[0].emailAddress;
					var customerName = tempData.data.message.data[0].firstName + " " + tempData.data.message.data[0].lastName;
					
					$.each(tempData.data.message.data[0].items, function(k, val) {
                        $("#productSummay tr:last").after("<tr><td>" + val.name + "</td>" +
							"<td>" + val.price + "</td>" +
							"<td>" + val.qty + "</td>" +
							"<td>" + (val.price * val.qty) + "</td></tr>");
                    });
					
					$("#orderId").text(orderId);
					$("#subTotal").text(subTotal);
					$("#shippingTotal").text(shippingTotal);
					$("#grandTotal").text(grandTotal);
					$("#billingInformation").text(billingInformation);
					$("#shippingInformation").text(shippingInformation);
					$("#emailAddress").text(emailAddress);
					$("#customerName").text(customerName);
					$("#orderConfirmContent").show();
				}else {
					alert(tempData.message);
				}
			}
		});
	});
</script>
<link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kprofile.css' rel='stylesheet' />
<link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kform.css' rel='stylesheet' />
<link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kcart.css' rel='stylesheet' />
<link type="text/css" href="<?php echo $this->resourcePath; ?>resources/css/kform.orig.css" rel="stylesheet">
</head>
<body>

<div class="up-bg" id="orderConfirmContent">
	<div class="container">
		<div class="up-mid-bg">
         	<div class="head-sec thnk-logo-sec">
         		<img src="<?php echo $this->resourcePath; ?>images/logo.png" alt="" class="logo"/>
                <img src="<?php echo $this->resourcePath; ?>images/ty-hdr.png" alt="" class="thanx-hdr-img">
         	</div>
<div class="congrts-txt" style='padding-bottom:30px;text-align:center;'><span style='font-weight:bold;'>Congratulations!</span><br>You've taken the first step to better health and wellness.<br> We are confident that you will enjoy the benefits of <strong>BioGold CBD</strong>.</div>
            <div class="thnk-ordr-box">
	<div class="kthanks" style="width:500px">
	
	<!-- remove this link if you do not want customers to be able to place a second order -->
	<a href="#" id="kthanks_reorderLink">Place a new order</a>
  
    <h3>
    	Thank you ! <span id="customerName"></span><br />
        ORDER#: <span id="orderId"></span><br /><br />    </h3>


    <div class="kthanks_box" style="width:480px; float:left">
        <div class="kthanks_boxTitle">
            Items Ordered
        </div>
        <div class="kthanks_boxContent">
			<div>
				<table id="productSummay" border="0" cellpadding="0" cellspacing="0" width="100" style="width:100%">
					<tr>
						<td style="width=20%; font-weight:bold">Product</td>
						<td style="width=10%; font-weight:bold">Price</td>
						<td style="width=10%; font-weight:bold">Qty.</td>
						<td style="width=10%; font-weight:bold">Amount</td>
					</tr>
				</table>
			</div>
            <hr />
            <div style="float:right">
                <div class="kthanks_spacer">
                    <div class="kthanks_label">
                        SubTotal:
                    </div>
					<span id="subTotal"></span>
				</div>
                <div class="kthanks_spacer">
                    <div class="kthanks_label">
                        S &amp; H:
                    </div>
					<span id="shippingTotal"></span>
				</div>
                                                                
				<div class="kthanks_spacer" style="border-top:1px solid #CCC">
                    <div class="kthanks_label" style="padding-top:5px">
                        Grand Total:
                    </div>
					<span id="grandTotal"></span>
				</div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    
    
    <div style="width:300px">
        
        <div class="kthanks_box">
            <div class="kthanks_boxTitle">
            Billing Information
            </div>
            <div class="kthanks_boxContent" id="billingInformation"></div>
        </div>
    
        <div class="kthanks_box">
            <div class="kthanks_boxTitle">
                Shipping Information
            </div>
            
            <div class="kthanks_boxContent" id="shippingInformation"></div>
			
        </div>
    </div>
	<div style="clear:both"></div>
	
	<div><span>*A confirmation email has been sent to  </span><span id="emailAddress">k@gmail.com</span></div>
        <div class="footer">
            <p class="ftrtxt">
            <a href="#">Terms & Conditions</a> | 
            <a href="#">Privacy Policy</a> | 
            <a href="#">Contact Us</a><br /> 
           Copyright <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script>  © - All Rights Reserved - BioGold CBD</p>
        </div>
  	</div>
</div>
</body>

<!-- Mirrored from trybiogoldextracts.com/thankyou.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:54:24 GMT -->
</html>
