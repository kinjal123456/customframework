<?php

class Upsell extends Controller
{
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
		$configData=Index::getCRMDetails();
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
        $response=Index::postHttpRequest($params, $endUrl);
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
}