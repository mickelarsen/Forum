<?php

class User extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('database_model');
	}
	
	public function index(){
		$data['subforums'] = $this->database_model->get_forum();
		$data['categories'] = $this->database_model->get_categories();
		$data['current_view'] = 'board_view';
		$this->load->view('template', $data);
	}
	
	public function register(){
		$data['current_view'] = 'create_user';
		$this->load->view('template', $data);
	}
	
	function user_login(){
		$user = array ('username' => $this->input->post('username'),
					   'password' => $this->input->post('password')
					   );
		if($this->database_model->user_login($user)){
			redirect('user/', 'refresh');
		}else{
			echo 'Username or password was incorrect.';
		}
	}
	
	public function user_profile(){
		$data['current_view'] = 'user_profile';
		$data['friends'] = $this->database_model->get_friends();
		$data['messages'] = $this->database_model->get_messages();
		$data['profile'] = $this->database_model->get_profile();
		$this->load->view('template', $data);
	}
	
	public function user_logout(){
		$this->session->sess_destroy();
		redirect('user/', 'refresh');
	}
	
	public function create_user(){
		$user = array ('username' => $this->input->post('username'),
					   'password' => $this->input->post('password')
					   );
		if($this->database_model->create_user($user)){
			$data['current_view'] = 'success';
			$this->load->view('template', $data);
		}else{
			$data['current_view'] = 'failure';
			$this->load->view('template', $data);
		}
	}
	
	public function edit_profile(){
		$data['current_view'] = 'edit_profile';
		$this->load->view('template', $data);
	}
	
	function submit_profile(){
		$profile = array ('real_name' => $this->input->post('real_name'),
						  'real_lastname' => $this->input->post('real_lastname'),
						  'location' => $this->input->post('location'),
						  'email' => $this->input->post('email'),
						  'birthday' => $this->input->post('birthday'),
						  'gravatar' => $this->input->post('gravatar'),
						  'signature' => $this->input->post('signature')
						  );
		$this->database_model->update_profile($profile);
		redirect('user/user_profile/'.$this->session->userdata('username'),'refresh');
	}
	
	function ban_user(){
		$moderator = array ('admin' => $this->session->userdata('admin'),
							'id' => $this->session->userdata('id')
							);
		if($moderator['admin'] != 1){
			echo 'The banhammer is too heavy for you.';
			redirect('user/index','refresh');
		}
		$ban_user = array ('user_to_be_banned' => $this->input->post('id'),
						   'moderator' => $moderator['id'],
						   'reason_message' => $this->input->post('reason')
						   );
		$this->database_model->ban_user($ban_user);
		$this->database_model->send_message($ban_user);
		redirect('user/','refresh');
	}
	
	function ignore_user(){
		$ignore_user = array ('user_wishing_to_ignore' => $this->session->userdata('username'),
							 'user_to_ignore' => $this->uri->segment(3)
							 );
		$this->database_model->ignore_user($ignore_user);
		redirect('user/', 'refresh');
	}
	
	public function new_message(){
		$data['current_view'] = 'new_message';
		$data['receiver'] = $this->uri->segment(3);
		$this->load->view('template', $data);
	}
	
	function send_messages(){
		$message = array ('sender' => $this->session->userdata('username'),
						  'receiver' => $this->input->post('receiver'),
						  'message' => $this->input->post('message')
						  );
		$this->database_model->send_message($message);
		redirect('user/','refresh');
	}
	
	function view_message(){
		$message = $this->uri->segment(3);
		$this->database_model->message_read($message);
		$data['message'] = $this->database_model->get_single_message($message);
		$data['current_view'] = 'message';
		$this->load->view('template', $data);
	}
	
	public function user_inbox(){
		$data['current_view'] = 'user_inbox';
		$data['messages'] = $this->database_model->get_messages();
		$this->load->view('template', $data);
	}
	
	public function view_friends(){
		$user = $this->session->userdata('username');
		$data['current_view'] = 'friends_list';
		$data['friends'] = $this->database_model->get_friends($user);
		$data['friend_requests'] = $this->database_model->get_friend_requests();
		$this->load->view('template', $data);
	}
	
	function friend_request(){
		$friend_request = array('user1' => $this->session->userdata('username'),
								'user2' => $this->input->post('user2')
								);
		$this->database_model->friend_request($friend_request);
		redirect('user/user_profile/'.$friend_request['user2'],'refresh');
	}
	
	function friendship(){
		$friendship = array ('user1' => $this->session->userdata('username'),
							 'user2' => $this->input->post('user2')
							 );
		$this->database_model->create_friendship($friendship);
		redirect('user/', 'refresh');
	}
	
	function friendship_decline(){
		$friendship_decline = array('user1' => $this->session->userdata('username'),
							 		'user2' => $this->input->post('user2')
							 	   );
		$this->database_model->remove_friend_request($friendship_decline);
		redirect('user/', 'refresh');
	}
	
}
