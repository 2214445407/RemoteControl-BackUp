<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function Commands($action = '') {
		$this->load->model('Request');
		switch($action) {
			case 'Get':
				if($this->Request->isPost()) {
					$data = array(
						'sec' => $this->input->post('SEC'),
						'ack' => $this->input->post('ACK'),
						'sip' => $this->input->post('SIP'),
						'hot' => $this->input->post('HOT'),
						'ipc' => $this->input->post('IPC'),
					);
					$continue = true;
					foreach($data as $s) {
						if($s == '' || $s == NULL) $continue = false;
					}
					if($continue) {
						$this->load->database();
						$this->load->model('ApiHandler');
						$result = $this->ApiHandler->Commands_Get($data);
						$this->res($result);
					} else {
						$this->res(false);
					}
				} else {
					$this->res(false);
				}
				break;
			case 'Fin':
				if($this->Request->isPost()) {
					$data = array(
						'sec' => $this->input->post('SEC'),
						'ack' => $this->input->post('ACK'),
						'cid' => $this->input->post('CID'),
						'res' => $this->input->post('RES'),
					);
					$continue = true;
					foreach($data as $s) {
						if($s == '' || $s == NULL) $continue = false;
					}
					if($continue) {
						$this->load->database();
						$this->load->model('ApiHandler');
						$result = $this->ApiHandler->Commands_Fin($data);
						$this->res($result);
					} else {
						$this->res(false);
					}
				} else {
					$this->res(false);
				}
				break;
			case 'Add':
				if($this->Request->isPost()) {
					$data = array(
						'pkt' => $this->input->post('PKT'),
						'sec' => $this->input->post('SEC'),
						'ack' => $this->input->post('ACK'),
						'act' => $this->input->post('ACT'),
						'tex' => $this->input->post('TEX'),
					);
					$continue = true;
					foreach($data as $s) {
						if($s == '' || $s == NULL) $continue = false;
					}
					if($continue) {
						$this->load->database();
						$this->load->model('ApiHandler');
						$result = $this->ApiHandler->Commands_Add($data);
						$this->res($result);
					} else {
						$this->res(false);
					}
				} else {
					$this->res(false);
				}
				break;
			case 'Del':
				if($this->Request->isPost()) {
					$data = array(
						'pkt' => $this->input->post('PKT'),
						'sec' => $this->input->post('SEC'),
						'cid' => $this->input->post('CID'),
					);
					$continue = true;
					foreach($data as $s) {
						if($s == '' || $s == NULL) $continue = false;
					}
					if($continue) {
						$this->load->database();
						$this->load->model('ApiHandler');
						$result = $this->ApiHandler->Commands_Del($data);
						$this->res($result);
					} else {
						$this->res(false);
					}
				} else {
					$this->res(false);
				}
				break;
			default:
				$this->res(false);
				break;
		}
	}
	public function Devices($action = '') {
		$this->load->model('Request');
		switch($action) {
			case 'Del':
				break;
			default:
				$this->res(false);
		}
	}
	public function Users($action = '') {

	}
	protected function res($data) {
		header('Content-Type: application/json;charset=UTF-8');
		$dejson = array('RIP' => $_SERVER['REMOTE_ADDR'], 'RES' => $data);
		$enjson = json_encode($dejson);
		echo $enjson;
	}
}