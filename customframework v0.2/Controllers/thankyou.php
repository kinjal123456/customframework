<?php

class Thankyou extends Controller
{
	//render thank you page
	public function thankyouAction()
	{
		$this->view->render("thankyou");
	}
	
	//This is a query order api method
	public function queryOrderAction()
	{
		$configData=Index::getCRMDetails();
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
				"message"=>"Query order: ".$resultArray["message"], 
				"result"=>"error", 
				"data"=>$resultArray 
			]);
			exit;
        }
	}
}