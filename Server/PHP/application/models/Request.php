<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Model {
	public function isGet() {
		return ($_SERVER['REQUEST_METHOD'] == 'GET') ? true : false;
	}
	public function isPost() {
		return ($_SERVER['REQUEST_METHOD'] == 'POST') ? true : false;
	}
	public function isLogin() {
		return ($this->session->userdata('userinfo') != NULL) ? true : false;
	}
	public function isAdmin() {
		return (($this->isLogin()) && $this->session->userdata('userinfo')['cid'] == '1') ? true : false;
	}
}