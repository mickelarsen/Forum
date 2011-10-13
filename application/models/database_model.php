<?php

class Database_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function create_user($user){
		if($this->db->insert('users', $user)){
			return true;
		}
		return false;
	}
	
	function get_forum(){
		$query = $this->db->get('subforums');
		$result = $query->result_array();
		return $result;
	}
	
	function get_categories(){
		$query = $this->db->get('categories');
		$result = $query->result_array();
		return $result;
	}
	
	function user_login($user){
		$query = $this->db->where('username', $user['username']);
		$query = $this->db->where('password', $user['password']);
		$query = $this->db->get('users');
		$result = $query->result_array();
		if($query){
			$this->session->set_userdata($result[0]);
			return true;
		}
		return false;
	}
	
	function update_profile($profile){
		$query = $this->db->where('username', $this->session->userdata('username'));
		if($query = $this->db->update('users', $profile)){
			return true;
		}
		return false;
	}
	
	function send_message($message){
		$query = $this->db->insert('messages', $message);
	}
	
	function get_messages(){
		$query = $this->db->where('receiver', $this->session->userdata('username'));
		$query = $this->db->get('messages');
		$result = $query->result_array();
		return $result;
	}
	
	function get_categories_by_subforum(){
		$subforum_id = $this->uri->segment(3);
		$query = $this->db->where('subforum_id', $subforum_id);
		$query = $this->db->get('categories');
		$result = $query->result_array();
		return $result;
	}
	
	function get_category(){
		$category_id = $this->uri->segment(3);
		$query = $this->db->where('id', $category_id);
		$query = $this->db->get('categories');
		$result = $query->result_array();
		return $result;
	}
	
	function get_subforum(){
		$subforum = $this->uri->segment(3);
		$query = $this->db->where('id', $subforum);
		$query = $this->db->get('subforums');
		$result = $query->result_array();
		return $result;
	}
	
	function get_profile(){
		$user = $this->uri->segment(3);
		$query = $this->db->where('username', $user);
		$query = $this->db->get('users');
		$result = $query->result_array();
		return $result;
	}
	
	function create_topic($topic){
		$this->db->insert('topics', $topic);
	}
	
	function get_topics(){
		$category = $this->uri->segment(3);
		$query = $this->db->where('category_id', $category);
		$query = $this->db->get('topics');
		$result = $query->result_array();
		return $result;
	}
	
	function get_topic(){
		$topic = $this->uri->segment(3);
		$query = $this->db->where('id', $topic);
		$query = $this->db->get('topics');
		$result = $query->result_array();
		return $result;
	}
	
	function new_topic_response($topic_response){
		$this->db->insert('topic_responses', $topic_response);
	}
	
	function get_topic_responses(){
		$topic = $this->uri->segment(3);
		$query = $this->db->where('id', $topic);
		$query = $this->db->get('topic_responses');
		$result = $query->result_array();
		return $result;
	}
	
}