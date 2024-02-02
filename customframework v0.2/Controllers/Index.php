<?php
require_once "Libs/Controller.php";
require_once "lead.php";
require_once "checkout.php";
require_once "upsell.php";
require_once "thankyou.php";
require_once "cvv.php";
session_start();

class Index extends Controller
{	
	//render lead page
	public function indexAction()
	{
		$lead = new Lead();
		$lead->leadAction();
	}
	
	//This is a import lead api method
	public function importLeadAction()
	{
		$lead = new Lead();
		$lead->importLeadAction();
	}
	
	//render checkout page
	public function checkoutAction()
	{
		$checkout = new Checkout();
		$checkout->checkoutAction();
	}
	
	//This is a create order api method
	public function createOrderAction()
	{
		$checkout = new Checkout();
		$checkout->createOrderAction();
	}
	
	//render upsell 1 page
	public function upsell1Action()
	{
		$upsell = new Upsell();
		$upsell->upsell1Action("upsell1");
	}
	
	//render upsell 2 page
	public function upsell2Action()
	{
		$upsell = new Upsell();
		$upsell->upsell2Action("upsell2");
	}
	
	//This is a import upsell api method
	public function importUpsellAction()
	{
		$upsell = new Upsell();
		$upsell->importUpsellAction();
	}
	
	//render thank you page
	public function thankyouAction()
	{
		$thankyou = new Thankyou();
		$thankyou->thankyouAction();
	}
	
	//This is a query order api method
	public function queryOrderAction()
	{
		$thankyou = new Thankyou();
		$thankyou->queryOrderAction();
	}
	
	//render cvv page
	public function cvvAction()
	{
		$cvv = new Cvv();
		$cvv->cvvAction();
	}
	
	//get crm configuration details
	public static function getCRMDetails()
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
	public static function postHttpRequest($params, $endUrl){
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