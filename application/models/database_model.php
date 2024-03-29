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
		if($this->check_ban($user) == true){
			echo 'You have been banned.';
			die;
		}else
		$query = $this->db->where('username', $user['username']);
		$query = $this->db->where('password', $user['password']);
		$query = $this->db->get('users');
		$result = $query->result_array();
		if($query){
			$this->session->set_userdata($result[0]);
			$query = $this->db->where('user', $user['username']);
			$query = $this->db->get('ignore_user');
			$ignored = $query->result_array();
			$this->session->set_userdata($ignored);
			return true;
		}
		return false;
		
	}
	
	function check_ban($user){
		$query = $this->db->where('banned_user', $user['username']);
		$query = $this->db->get('banned_user');
		$result = $query->result_array();
		if($result[0]['banned_user'] == $user['username']){
			return true;
		}
		return false;
	}
	
	function ignore_user(){
		$this->db->insert('ignore_user');
	}
	
	function moderator_promotion($user_to_be_promoted){
		$this->db->where('username', $user_to_be_promoted);
		$this->db->update('users', array('admin' => 1));
	}
	
	function friend_request($friend_request){
		$this->db->insert('friend_request', $friend_request);
	}
	
	function get_friend_requests(){
		$query = $this->db->where('user2', $this->session->userdata('username'));
		$query = $this->db->get('friend_request');
		$result = $query->result_array();
		return $result;
	}
	
	function create_friendship($friendship){
		if($this->db->insert('friends_list', $friendship)){
			$friendship2 = array('user1' => $friendship['user2'],
								 'user2' => $friendship['user1']
								 );
			$this->db->insert('friends_list', $friendship2);
			$this->db->where('user1', $friendship['user2']);
			$this->db->where('user2', $friendship['user1']);
			$this->db->delete('friend_request');
		}
	}
	
	function get_friends(){
		$query = $this->db->where('user1', $this->session->userdata('username'));
		$query = $this->db->get('friends_list');
		$result = $query->result_array();
		return $result;
	}
	
	function remove_friend($friend_to_remove){
		$query = $this->db->where('user1', $this->session->userdata('username'));
		$query = $this->db->where('user2', $friend_to_remove);
		$query = $this->db->delete('friends_list');
		if($query){
			$this->db->where('user2', $this->session->userdata('username'));
			$this->db->where('user1', $friend_to_remove);
			$this->db->delete('friends_list');
		}
	}
	
	function ban_user($ban){
		$this->db->insert('banned_user', $ban);
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
	
	function message_read($message){
		$array = array('read' => 1);
		$this->db->where('message_id', $message);
		$this->db->update('messages', $array);
	}
	
	function get_messages(){
		$query = $this->db->where('receiver', $this->session->userdata('username'));
		$query = $this->db->get('messages');
		$result = $query->result_array();
		return $result;
	}
	
	function get_single_message($message_id){
		$query = $this->db->where('message_id', $message_id);
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
	
	function get_topics($top_limit, $bot_limit){
		$category = $this->uri->segment(3);
		$query = $this->db->where('category_id', $category);
		$query = $this->db->order_by('sticky', 'desc');
		$query = $this->db->get('topics', $top_limit, $bot_limit);
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
	
	function sticky_topic($sticky){
		$sticky_topic = array('sticky' => 1);
		$this->db->where('id', $sticky);
		$this->db->update('topics', $sticky_topic);
	}
	
	function lock_topic($topic_to_be_locked){
		$locked_topic = array('locked' => 1);
		$this->db->where('id', $topic_to_be_locked);
		$this->db->update('topics', $locked_topic);
	}
	
	function new_topic_response($topic_response){
		$this->db->insert('topic_responses', $topic_response);
	}
	
	function get_topic_responses($top_limit, $bot_limit){
		$topic = $this->uri->segment(3);
		$query = $this->db->where('topic_id', $topic);
		$query = $this->db->limit($top_limit, $bot_limit);
		$query = $this->db->get('topic_responses');
		$result = $query->result_array();
		return $result;
	}
	
	function get_topic_response($response_to_edit){
		$this->db->where('id', $response_to_edit);
		$this->db->get('topic_responses');
	}
	
	function edit_response($edited_response){
		$this->db->where('id', $edited_response['id']);
		$this->db->update('topic_responses', $edited_response);
	}
}
