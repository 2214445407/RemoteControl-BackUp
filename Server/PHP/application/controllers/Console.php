<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {
	public function Index() {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isLogin()) {
			$this->load->database();
			$this->load->model('ConsoleHandler');
			$data = $this->ConsoleHandler->Index();
			$this->load->view('Console/Index', $data);
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Devices($action = '', $param = '') {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isLogin()) {
			$this->load->database();
			$this->load->model('ConsoleHandler');
			switch($action) {
				case 'List':
					$data = $this->ConsoleHandler->Devices_List();
					$this->load->view('Console/Devices/List', $data);
					break;
				case 'Info':
					$data = $this->ConsoleHandler->Devices_Info($param);
					$this->load->view('Console/Devices/Info', $data);
					break;
				case 'Delete':
					if($this->ConsoleHandler->Devices_Delete($param)) {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '删除成功', 'url' => '/Console/Deevices/List'));
					} else {
						$this->load->view('Jumper', array('code' => 0, 'msg' => '删除失败', 'url' => '/Console/Deevices/List'));
					}
					break;
				default:
					break;
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Commands($action = '', $param = '') {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isLogin()) {
			$this->load->database();
			$this->load->model('ConsoleHandler');
			switch($action) {
				case 'Add':
					if($this->Request->isPost()) {
						$data = array(
							'ack' => $param,
							'act' => $this->input->post('act'),
							'tex' => $this->input->post('tex'),
						);
						$continue = true;
						foreach($data as $s) {
							if($s == '' || $s == NULL) $continue = false;
						}
						if($continue && $this->ConsoleHandler->Commands_Add($data)) {
							$this->load->view('Jumper', array('code' => 1, 'msg' => '添加成功', 'url' => '/Console/Commands/List'));
						} else {
							$this->load->view('Jumper', array('code' => 1, 'msg' => '添加失败', 'url' => '/Console/Devices/List'));
						}
					} else {
						$data['ack'] = $param;
						$this->load->view('/Console/Commands/Add', $data);
					}
					break;
				case 'List':
					$data = $this->ConsoleHandler->Commands_List();
					$this->load->view('Console/Commands/List', $data);
					break;
				case 'Info':
					$data = $this->ConsoleHandler->Commands_Info($param);
					$this->load->view('Console/Commands/Info', $data);
					break;
				case 'Delete':
					if($this->ConsoleHandler->Commands_Delete($param)) {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '删除成功', 'url' => '/Console/Commands/List'));
					} else {
						$this->load->view('Jumper', array('code' => 0, 'msg' => '删除失败', 'url' => '/Console/Commands/List'));
					}
					break;
				default:
					break;
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Users($action = '', $param = '') {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isAdmin()) {
			$this->load->database();
			$this->load->model('ConsoleHandler');
			switch($action) {
				case 'List':
					$data = $this->ConsoleHandler->Users_List();
					$this->load->view('Console/Users/List', $data);
					break;
				case 'Info':
					$data = $this->ConsoleHandler->Users_Info($param);
					$this->load->view('Console/Users/Info', $data);
					break;
				case 'Delete':
					if($this->ConsoleHandler->Users_Delete($param)) {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '删除成功', 'url' => '/Console/Users/List'));
					} else {
						$this->load->view('Jumper', array('code' => 0, 'msg' => '删除失败', 'url' => '/Console/Users/List'));
					}
					break;
				default:
					break;
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Profile() {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isLogin()) {
			$this->load->database();
			$this->load->model('ConsoleHandler');
			if($this->Request->isPost()) {
				$data = array(
					'pwd' => $this->input->post('password'),
					'ema' => $this->input->post('emailadd'),
				);
				if($data['ema'] == '' || $data['ema'] != NULL || $data['pwd'] != NULL) {
					if($this->ConsoleHandler->Profile($data)) {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '修改成功', 'url' => '/Console/Profile'));
					} else {
						$this->load->view('Jumper', array('code' => 0, 'msg' => '修改失败', 'url' => '/Console/Profile'));
					}
				} else {
					$this->load->view('Jumper', array('code' => 0, 'msg' => '修改失败', 'url' => '/Console/Profile'));
				}
			} else {
				$this->load->view('Console/Profile');
			}
		}
	}
	public function Configs() {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isAdmin()) {
			if($this->Request->isPost()) {
				$data = array(
					'sin' => $this->input->post('sin'),
					'cpr' => $this->input->post('cpr'),
					'reg' => $this->input->post('reg'),
					'wwh' => $this->input->post('wwh'),
				);
				$this->load->database();
				$this->load->model('ConsoleHandler');
				$this->load->helper('file');
				if($this->ConsoleHandler->Configs($data)) {
					$this->load->view('Jumper', array('code' => 1, 'msg' => '保存成功', 'url' => 'last'));
				} else {
					$this->load->view('Jumper', array('code' => 0, 'msg' => '保存失败', 'url' => 'last'));
				}
			} else {
				$this->load->view('Console/Configs');
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function SystemPurge() {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isAdmin()) {
			$this->load->database();
			$this->db->query('TRUNCATE TABLE devices');
			$this->db->query('TRUNCATE TABLE commands');
			$this->load->view('Jumper', array('code' => 1, 'msg' => '清理完毕', 'url' => 'last'));
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Update($action = '') {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isAdmin()) {

		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
	public function Login() {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isPost()) {
			$data = array(
				'usr' => $this->input->post('username'),
				'pwd' => $this->input->post('password'),
			);
			$continue = true;
			foreach($data as $s) {
				if($s == '' || $s == NULL) $continue = false;
			}
			if($continue) {
				$this->load->database();
				$this->load->model('ConsoleHandler');
				$result = $this->ConsoleHandler->Login($data);
				if($result) {
					$this->load->view('Jumper', array('code' => 1, 'msg' => '登录成功', 'url' => 'Index'));
				} else {
					$this->load->view('Jumper', array('code' => 0, 'msg' => '登录失败', 'url' => '/Console/Login'));
				}
			} else {
				$this->load->view('Jumper', array('code' => 0, 'msg' => '登录失败', 'url' => '/Console/Login'));
			}
		} else {
			$this->load->view('Console/Login');
		}
	}
	public function Register() {
		include APPPATH . '../config.inc.php';
		$this->load->library('session');
		$this->load->model('Request');
		if($sites['configs']->register == 'on') {
			if($this->Request->isPost()) {
				$data = array(
					'usr' => $this->input->post('username'),
					'pwd' => $this->input->post('password'),
					'ema' => $this->input->post('emailadd'),
				);
				$continue = true;
				foreach($data as $s) {
					if($s == '' || $s == NULL) $continue = false;
				}
				$this->load->helper('email');
				if($continue && valid_email($data['ema'])) {
					$this->load->database();
					$this->load->helper('string');
					$this->load->model('ConsoleHandler');
					$result = $this->ConsoleHandler->Register($data);
					if($result) {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '注册成功', 'url' => '/Console/Login'));
					} else {
						$this->load->view('Jumper', array('code' => 1, 'msg' => '注册失败', 'url' => 'Register'));
					}
				} else {
					$this->load->view('Jumper', array('code' => 1, 'msg' => '注册失败', 'url' => 'Register'));
				}
			} else {
				$this->load->view('Console/Register');
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '注册接口已关闭', 'url' => 'last'));
		}
	}
	public function Logout() {
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->load->view('Jumper', array('code' => 1, 'msg' => '已登出', 'url' => '/Console/Login'));
	}
	public function Keys($action = '') {
		$this->load->library('session');
		$this->load->model('Request');
		if($this->Request->isLogin()) {
			$this->load->helper('string');
			$this->load->database();
			$this->load->model('ConsoleHandler');
			$data = $this->session->userdata('userinfo')['cid'];
			switch($action) {
				case 'SEC':
					$this->ConsoleHandler->Keys_SEC($data);
					break;
				case 'PKT':
					$this->ConsoleHandler->Keys_PKT($data);
					break;
				default:
					break;
			}
		} else {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '未授权的访问', 'url' => '/Console/Login'));
		}
	}
}