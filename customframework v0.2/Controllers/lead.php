<?php

class Lead extends Controller
{
	//render lead page
	public function leadAction()
	{
		$this->view->render("index");
	}
	
	//This is a import lead api method
	public function importLeadAction()
	{
		$configData=Index::getCRMDetails();
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
        
        $response =	Index::postHttpRequest($params, $endUrl);
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
}