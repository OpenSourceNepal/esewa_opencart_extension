<?php 
/* 
 * Hellopaisa online payment
 *
 * @version 1.0
 * @date 21/12/2013
 * @author Yujesh K.C (Khadka) <ujesh.kc@gmail.com>
 * @more info available on w3webstudio.com
 */
class ControllerPaymentEsewa extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/esewa');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');	
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('esewa', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$this->data['entry_esewa'] = $this->language->get('entry_esewa');
		
		$this->data['esewa_name'] = $this->language->get('esewa_name');
		
		$this->data['text_live'] = $this->language->get('text_live');
		$this->data['text_demo'] = $this->language->get('text_demo');
		
		$this->data['esewa_sandbox'] = $this->language->get('esewa_sandbox');
		

		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		
		if (isset($this->error['esewa_id'])) {
			$this->data['esewa_id'] = $this->error['esewa_id'];
		} else {
			$this->data['esewa_id'] = '';
		}

		

		
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language) {
			if (isset($this->error['esewa_' . $language['language_id']])) {
				$this->data['error_esewa_' . $language['language_id']] = $this->error['esewa_' . $language['language_id']];
			} else {
				$this->data['error_esewa_' . $language['language_id']] = '';
			}
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/esewa', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/esewa', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/language');
		
		foreach ($languages as $language) {
			if (isset($this->request->post['esewa_transfer_' . $language['language_id']])) {
				$this->data['esewa_transfer_' . $language['language_id']] = $this->request->post['esewa_transfer_' . $language['language_id']];
			} else {
				$this->data['esewa_transfer_' . $language['language_id']] = $this->config->get('esewa_transfer_' . $language['language_id']);
			}
		}
		
		$this->data['languages'] = $languages;
		
		if (isset($this->request->post['esewa_total'])) {
			$this->data['esewa_total'] = $this->request->post['esewa_total'];
		} else {
			$this->data['esewa_total'] = $this->config->get('esewa_total'); 
		} 
				
		if (isset($this->request->post['esewa_order_status_id'])) {
			$this->data['esewa_order_status_id'] = $this->request->post['esewa_order_status_id'];
		} else {
			$this->data['esewa_order_status_id'] = $this->config->get('esewa_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['esewa_geo_zone_id'])) {
			$this->data['esewa_geo_zone_id'] = $this->request->post['esewa_geo_zone_id'];
		} else {
			$this->data['esewa_geo_zone_id'] = $this->config->get('esewa_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['esewa_status'])) {
			$this->data['esewa_status'] = $this->request->post['esewa_status'];
		} else {
			$this->data['esewa_status'] = $this->config->get('esewa_status');
		}
		
		if (isset($this->request->post['esewa_mode'])) {
			$this->data['esewa_mode'] = $this->request->post['esewa_mode'];
		} else {
			$this->data['esewa_mode'] = $this->config->get('esewa_mode');
		}
		
		if (isset($this->request->post['esewa_sort_order'])) {
			$this->data['esewa_sort_order'] = $this->request->post['esewa_sort_order'];
		} else {
			$this->data['esewa_sort_order'] = $this->config->get('esewa_sort_order');
		}
		
		if (isset($this->request->post['esewa_id'])) {
			$this->data['esewa_id'] = $this->request->post['esewa_id'];
		} else {
			$this->data['esewa_id'] = $this->config->get('esewa_id');
		}
		

		$this->template = 'payment/esewa.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/esewa')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();
		
		if (!$this->request->post['esewa_id']) {
			$this->error['esewar_id'] = $this->language->get('esewar_id');
		}
		
		
		
		foreach ($languages as $language) {
			if (!$this->request->post['esewa_transfer_' . $language['language_id']]) {
				$this->error['esewa_' .  $language['language_id']] = $this->language->get('error_esewa');
			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>