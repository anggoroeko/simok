<?php if(!defined('BASEPATH')) exit('No direct Script Allowed');

/**
 * 
 */
class M_users extends CI_Model {
	function show(){
		$query = "SELECT user.`userId`, user.`UserMsSttsId`, user.`userName`, user.`userFullName`, `user`.`userImgName`, `user`.`userImgType`, master_user_status.`msUserSttsName` 
				  FROM user INNER JOIN master_user_status 
				  ON user.`UserMsSttsId` = master_user_status.`msUserSttsId`
				  WHERE userStatus = 1 ";
		$result = $this->db->query($query);
		
		return $result->result_array();
	}
	
	function add($data){
		$this->db->insert('user', $data);
	}
	
	function master_status(){
		$query = "SELECT * FROM master_user_status WHERE msUserSttsStatus = 1";
		$result = $this->db->query($query);
		
		return $result->result_array();
	}
	
	function deleted($idUser, $data){
		$this->db->where('userId', $idUser);
		$this->db->update('user', $data);
	}
	
	function edit($idUser){
		$query = "SELECT user.`userId`, user.`userMsSttsId`, user.`userFullName`, user.username, master_user_status.`msUserSttsName` 
				  FROM user INNER JOIN master_user_status 
				  ON user.`userMsSttsId` = master_user_status.`msUserSttsId`
				  WHERE userId = $idUser";
		
		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	function edited($userId, $data){
		$this->db->where('userId', $userId);
		$this->db->update('user', $data);
	}
}