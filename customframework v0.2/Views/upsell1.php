
<!DOCTYPE html>
<html>
<!-- Mirrored from trybiogoldextracts.com/upsell1.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:54:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kprofile.css' rel='stylesheet' />
<link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kform.css' rel='stylesheet' />
<link  type='text/css' href='<?php echo $this->resourcePath; ?>resources/css/kcart.css' rel='stylesheet' />
		    
<title>BioGold CBD</title>
<title></title>
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="content-language" content="en-us">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" href="<?php echo $this->resourcePath; ?>css/biogold.css">
<meta name="description" content="">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="<?php echo $this->resourcePath; ?>css/biogold_2.css">
<link href="<?php echo $this->resourcePath; ?>css/upsell.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->resourcePath; ?><?php echo $this->resourcePath; ?>images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
<script src="<?php echo $this->resourcePath; ?>js/jquery.min.js" type="text/javascript"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#kformSubmita, #kformSubmit').on('click', function(){
			var upsellProduct1 = $("input[name=productId]").val();
			$.ajax({
				type: 'post',
				url: 'importUpsell',
				data: {upsell: 1, upsellProduct1: upsellProduct1},
				success: function(responseData) {
				var tempData = JSON.parse(responseData);
					if(tempData.result == "success")
						window.location.href="upsell2";
					else
						alert(tempData.message);
				}
			});
		});
	});
</script>

</head>
<body cz-shortcut-listen="true">
   <div class="up-bg">
  <div class="container">
    <div class="up-mid-bg">
      <div class="up-top">
        <p class="up-top-txt">SPECIAL OFFER UNLOCKED: INSTANT SAVINGS FOR FIRST TIME CUSTOMERS</p>
      </div>
      <div class="head-sec"> <img src="<?php echo $this->resourcePath; ?>images/logo.png" alt="" class="logo">
                <!--<div class="hd-arrow-bg">
                    <p class="hd-txt2">Special Offer<br><span>BioGold CBD Gummies</span> </p>
                    <img src="<?php echo $this->resourcePath; ?>images/up1-bottles.png" width="48" height="82" alt="" class="hd-bootle1" /> 
                </div>-->
      </div>
      <div class="strip">
        <p class="strip-txt1">Wait! You Qualify For A Limited Time Discount</p>
                <p class="strip-txt2">Many customers who purchase <span>BioGold CBD Oil</span> also purchased <span>BioGold CBD Gummies</span></p>	

      </div>
      <div class="up-bg2" style='background: url(<?php echo $this->resourcePath; ?>images/gummies_bg.jpg) center top no-repeat;'>
        <div class="up-bg1-left"> <img src="<?php echo $this->resourcePath; ?>images/up1-bottles.png"> </div>
        <div class="up-bg1-right">
            	<div class="up-bg1-right">
                	<p class="up-bg1-right-txt1"><b>Amplify YOUR RESULTS</b><br><span>with</span> 
					<br><b class="cog" style="text-transform:none;">BioGold CBD Gummies</b><br>
                	<span>Natural Cannabidiol Complex</span>
                    </p>
                	<p class="up-bg1-right-txt2">Get Your Exclusive Discounted Bottle</span><br />
Just Pay a <span>Special One Time Price</span> </span><br /><span class="price">$39.99</span></p>
                    <p class="up-bg1-right-txt3">
                        <img src="<?php echo $this->resourcePath; ?>images/arrow1.png" alt="" class="arrow1" />
                        You Save $20
                        <img src="<?php echo $this->resourcePath; ?>images/arrow2.png"  alt="" class="arrow2" />
                    </p>
		<form id="kform"  onsubmit=\"return false\">
			<input type="hidden" name="productId" value="278" noSaveFormValue readonly>
			<br><br>
			
              		<center><a class="ck-btn pulse"><img id='kformSubmit' class='fg' src="<?php echo $this->resourcePath; ?>images/ck-btn.png"></a></center>
		</form>
		    

             	</div>
      </div>
      <div class="strip" style="height:99px;">
        <p class="strip2-txt1">HOW <span>BioGold CBD Gummies</span> WORKS<br>
          TO <span>SUPPORT HEALTH &amp; WELLNESS</span> </p>
      </div>
      <p class="clearall"></p>
      <div class="three-box">
          <div class="box1"> <img src="<?php echo $this->resourcePath; ?>images/box1-img.jpg" alt="box1-img2">
            <p class="box-txt1">Easy To Use Formula</p>
                    <p class="box-txt2">BioGold CBD Gummies is easy to chew, making it easy to integrate into your daily routine. </p>
               </div>
          <div class="box2"> <img src="<?php echo $this->resourcePath; ?>images/box2-img2.jpg" alt="box2-img2.jpg">
           <p class="box-txt1">Supports Joint Health</p>
                    <p class="box-txt2">BioGold CBD Gummies helps support joint health and flexibility while also reducing muscle wear &amp; tear. </p>
                </div>
          <div class="box3"> <img src="<?php echo $this->resourcePath; ?>images/box3-img2.jpg" alt="box3-img2">
           <p class="box-txt1">Reduces Anxiety &amp; Stress</p>
                    <p class="box-txt2">BioGold CBD Gummies helps trigger a positive stress response to improve mood patterns. </p>
                </div>
          <p class=" clearall"></p>
          <center>
            <div id='kformSubmita' style='cursor:pointer;'><img src="<?php echo $this->resourcePath; ?>images/ck-btn.png" width="356" height="92" alt=""></div>
          </center>
          <a href="upsell2" class="cut-txt"><img src="<?php echo $this->resourcePath; ?>images/cut.png" width="18" height="15" alt="" class="cut-txt"> No, Thanks. I decline the offer</a>
        <div class="footer">
            <p class="ftrtxt">
            <a href="#">Terms & Conditions</a> | 
            <a href="#">Privacy Policy</a> | 
            <a href="#">Contact Us</a><br /> 
           Copyright <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script>  © - All Rights Reserved - BioGold CBD</p>
        </div>
	  
        </div>
</div>
  </div>
</div>

<p id="loading-indicator" style="display:none;">Processing...</p>

</body>

<!-- Mirrored from trybiogoldextracts.com/upsell1.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jul 2020 12:54:19 GMT -->
</html>
