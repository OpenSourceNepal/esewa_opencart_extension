<?php
class ControllerPaymentEsewa extends Controller {
	protected function index() {
		
		$this->language->load('payment/esewa');
		
		
		
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		
		
		if($order_info){	
		
				$action_status = $this->config->get('esewa_mode');
				
				
				//if action_status == 1 then it is in live mode else it is in testing mode
				if($action_status == 1){
					$this->data['action_st'] = 'http://esewa.com.np/epay/main';
					}
				else{
					$this->data['action_st'] = 'http://dev.esewa.com.np/epay/main';
					}
		
				
				
						
				$this->data['text_instruction'] = $this->language->get('text_instruction');
				$this->data['text_description'] = $this->language->get('text_description');
				$this->data['text_payment'] = $this->language->get('text_payment');				
				$this->data['button_confirm'] = $this->language->get('button_confirm');				
				$this->data['totalamount'] = $order_info['total'];	
				
				$this->data['productid'] = trim($this->config->get('config_name')) . '-' . $this->session->data['order_id'];
				
				//$this->data['ap_itemname'] = $this->config->get('config_name') . ' - #' . $this->session->data['order_id'];
				//$this->data['ap_itemcode'] = $this->session->data['order_id'];
								
				$this->data['merchantcode'] = $this->config->get('esewa_id');	
							
				//$product = 	$this->data['orderamount'] = $this->currency->format($order_info['total'], $currency , false, false);	
							
				$this->data['esewa'] = nl2br($this->config->get('esewa_transfer_' . $this->config->get('config_language_id')));		
				$this->data['continue'] = $this->url->link('checkout/success');
				
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/esewa.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/esewa.tpl';
				} else {
					$this->template = 'default/template/payment/esewa.tpl';
				}	
				
				$this->render(); 
			
			}
		
		
	}

	public function confirm() {
		if(isset($this->session->data['order_id'])){
			
		$this->language->load('payment/esewa');		
		$this->load->model('checkout/order');
		
	
			
		$comment  = $this->language->get('text_instruction') . "\n\n";
		

		$comment .= $this->language->get('text_payment');
				$comment .= $this->config->get('esewa_transfer_' . $this->config->get('config_language_id')) . "\n\n";
			if(isset($_GET['refId'])){
			
			$comment .= "---------------------- \n\n\n E-sewa reference Id : ".$this->data['reffId'] = $_GET['refId'];
			
		}
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('esewa_order_status_id'), $comment, true);
	
		$this->redirect($this->url->link('checkout/success', '', 'SSL'));
			}	
			else{
				$this->redirect($this->url->link('error/index'));
				}
		
	}
}
?>