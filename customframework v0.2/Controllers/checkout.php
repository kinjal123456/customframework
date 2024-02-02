<?php

class Checkout extends Controller
{
	//render checkout page
	public function checkoutAction()
	{
		$this->view->render("checkout");
	}
	
	//This is a create order api method
	public function createOrderAction()
	{
		$configData=Index::getCRMDetails();
		if(!isset($_SESSION['order-data']['message']['orderId'])){
    		echo json_encode([
				"message"=>"Please create lead first then create order.", 
				"result"=>"error", 
				"data"=>[] 
			]);
			exit;
    	}
        $params =   [
            'loginId'         	=> $configData["crmUserId"],
            'password'         	=> $configData["crmPassword"],
            'billShipSame'    	=> 1,
            'paySource'    		=> "CREDITCARD",
            'campaignId'     	=> (isset($_REQUEST['switchCampaign']) && $_REQUEST['switchCampaign']=="false")?trim($_SESSION['order-data']['message']['campaignId']):"78",
            'product1_id'		=> (isset($_REQUEST['switchCampaign']) && $_REQUEST['switchCampaign']=="false")?$_REQUEST["productId"]:"285"
        ];

		$params['orderId']    = trim($_SESSION['order-data']['message']['orderId']);
		$params['billShipSame']    = intval($_REQUEST['billShipSame']);
		$params['cardNumber']    = strlen(trim($_REQUEST['cardNumber']))>0?trim($_REQUEST['cardNumber']):"";
		$params['cardMonth']    = intval($_REQUEST['cardMonth']);
		$params['cardYear']    = intval($_REQUEST['cardYear']);
		$params['cardSecurityCode']    = intval($_REQUEST['cardSecurityCode']);
		
		if(intval($_REQUEST['billShipSame'])==0){
			// $params['shipFirstName']    = "Test first name";
			// $params['shipLastName']     = "lastName";
			// $params['shipAddress2']     = "Test address1";
			// $params['shipCity']     = "Test address2";
			// $params['shipState']   = "90001";
			// $params['shipCountry']         = "Test City";
		}

        $creditCardType = '	CREDITCARD';        
        $endUrl 		= $configData["crmUrl"]."/order/import/";
        
        $response	=	Index::postHttpRequest($params, $endUrl);
        $resultArray	=	json_decode($response, true);

        if($resultArray["result"]=="SUCCESS"){
            $_SESSION['order-data']=$resultArray;
            echo json_encode([
            	"message"=>"success", 
            	"result"=>"success", 
            	"data"=>$resultArray
            ]); exit;
        } else {

            echo json_encode([
            	"message"=>$resultArray["message"], 
            	"result"=>"error", 
            	"data"=>$resultArray 
            ]);
            exit;
        }
	}
}