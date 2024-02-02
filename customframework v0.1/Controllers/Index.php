<?php
require_once "Libs/Controller.php";
session_start();

class Index extends Controller
{	
	//render lead page
	public function leadAction()
	{
		$this->view->render("index");
	}
	
	//This is a import lead api method
	public function importLeadAction()
	{
		$configData=$this->getCRMDetails();
		$params =   [
            'loginId'         	=> $configData["crmUserId"],
            'password'         	=> $configData["crmPassword"],
			'billShipSame'    	=> 1,
            'campaignId'     	=> $configData["crmCampaignId"]
        ];
		
		$params['firstName']    = strlen(trim($_REQUEST['firstName']))>0?trim($_REQUEST['firstName']):"";
        $params['lastName']     = strlen(trim($_REQUEST['lastName']))>0?trim($_REQUEST['lastName']):"";
        $params['address1']     = strlen(trim($_REQUEST['address1']))>0?trim($_REQUEST['address1']):"";
        $params['postalCode']   = strlen(trim($_REQUEST['postalCode']))>0?trim($_REQUEST['postalCode']):"";
        $params['city']         = strlen(trim($_REQUEST['city']))>0?trim($_REQUEST['city']):"";
        $params['state']        = strlen(trim($_REQUEST['state']))>0?trim($_REQUEST['state']):"";
        $params['country']      = strlen(trim($_REQUEST['country']))>0?trim($_REQUEST['country']):"";
        $params['postalCode']      = strlen(trim($_REQUEST['postalCode']))>0?trim($_REQUEST['postalCode']):"";
        $params['emailAddress'] = strlen(trim($_REQUEST['emailAddress']))>0?trim($_REQUEST['emailAddress']):"";
        $params['phoneNumber']  = strlen(trim($_REQUEST['phoneNumber']))>0?trim($_REQUEST['phoneNumber']):"";
		
		$endUrl = $configData["crmUrl"]."/leads/import/";
        
        $response =	$this->postHttpRequest($params, $endUrl);
        $resultArray = json_decode($response, true);

        if($resultArray["result"]=="SUCCESS"){
            $_SESSION['order-data']=$resultArray;
            echo json_encode([
            	"message"=>"success", 
            	"result"=>"success", 
            	"data"=>$resultArray
            ]); exit;
        } else {
            echo json_encode([
            	"message"=>"Import lead: ".$resultArray["message"], 
            	"result"=>"error", 
            	"data"=>$resultArray 
            ]);
            exit;
        }
	}

	//render checkout page
	public function checkoutAction()
	{
		$this->view->render("checkout");
	}
	
	//This is a create order api method
	public function createOrderAction()
	{
		$configData=$this->getCRMDetails();
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
        
        $response	=	$this->postHttpRequest($params, $endUrl);
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
	
	//render upsell 1 page
	public function upsell1Action()
	{
		$this->view->render("upsell1");
	}
	
	//render upsell 2 page
	public function upsell2Action()
	{
		$this->view->render("upsell2");
	}
	
	//This is a import upsell api method
	public function importUpsellAction()
	{
		$configData=$this->getCRMDetails();
		if(!isset($_SESSION['order-data']['message']['orderId'])){
    		echo json_encode([
				"message"=>"Please create a order first then create upsell.", 
				"result"=>"error", 
				"data"=>[] 
			]);
			exit;
    	}

    	$params = [
            'loginId' 		=> $configData["crmUserId"],
            'password' 		=> $configData["crmPassword"],
            'orderId'    	=> $_SESSION['order-data']['message']['orderId']
        ];
		
		if(isset($_REQUEST["upsell"]) && intval($_REQUEST["upsell"])==1){
			if($_SESSION["order-data"]["message"]["campaignId"]==$configData["crmCampaignId"])
				$params['product1_id']    = $_REQUEST["upsellProduct1"];
			else
				$params['product1_id']    = "286";
		}else {
			if($_SESSION["order-data"]["message"]["campaignId"]==$configData["crmCampaignId"])
				$params['product1_id']    = $_REQUEST["upsellProduct2"];
			else
				$params['product1_id']    = "289";
		}

        $endUrl=$configData["crmUrl"]."/upsale/import/";
        $response=$this->postHttpRequest($params, $endUrl);
        $resultArray=json_decode($response,true);

        if($resultArray["result"]=="SUCCESS"){
			echo json_encode([
				"message"=>"success", 
				"result"=>"success", 
				"data"=>$resultArray 
			]); 
			exit;
        }else{
			echo json_encode([
				"message"=>"Import upsell: ".$resultArray["message"], 
				"result"=>"error", 
				"data"=>$resultArray 
			]);
			exit;
        }
	}
	
	//render thank you page
	public function thankyouAction()
	{
		$this->view->render("thankyou");
	}
	
	//render cvv page
	public function cvvAction()
	{
		$this->view->render("cvv");
	}
	
	//This is a query order api method
	public function queryOrderAction()
	{
		$configData=$this->getCRMDetails();
		if(!isset($_SESSION['order-data']['message']['lastName']) && !isset($_SESSION['order-data']['message']['dateCreated'])){
    		echo json_encode([
				"message"=>"Please place order.", 
				"result"=>"error", 
				"data"=>[] 
			]);
			exit;
    	}

    	$params = [
            'loginId' 		=> $configData["crmUserId"],
            'password' 		=> $configData["crmPassword"],
			'orderId'    	=> $_SESSION['order-data']['message']['orderId']
        ];

        $endUrl=$configData["crmUrl"]."/order/query/";
        $response=$this->postHttpRequest($params, $endUrl);
        $resultArray=json_decode($response,true);

        if($resultArray["result"]=="SUCCESS"){
			echo json_encode([
				"message"=>"success", 
				"result"=>"success", 
				"data"=>$resultArray 
			]); 
			exit;
        }else{
			echo json_encode([
				"message"=>"Query order: ".$resultArray["message"], 
				"result"=>"error", 
				"data"=>$resultArray 
			]);
			exit;
        }
	}
	
	//get crm configuration details
	public function getCRMDetails()
	{
		$configData=require_once "Config/app.php";
		return $crmDetails = [
			"crmUrl" => $configData["crmUrl"],
			"crmUserId" => $configData["crmUserId"],
			"crmPassword" => $configData["crmPassword"],
			"crmCampaignId" => $configData["crmCampaignId"]
		];
	}
	
	//curl request/response
	public function postHttpRequest($params, $endUrl){
		$curlSession = curl_init();
		curl_setopt($curlSession,CURLOPT_URL,$endUrl);
		curl_setopt($curlSession, CURLOPT_POST, 2);
		curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlSession, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($curlSession);
		$error = curl_error($curlSession);

		curl_close($curlSession);

		if ($error) {
			return "cURL Error #:" . $error;
		} else {
			return $response;
		}
	}
}