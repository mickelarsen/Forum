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
			redirect('user/index', 'refresh');
		}else{
			echo 'Username or password was incorrect.';
		}
	}
	
	public function user_profile(){
		$data['current_view'] = 'user_profile';
		$data['profile'] = $this->database_model->get_profile();
		$this->load->view('template', $data);
	}
	
	public function user_logout(){
		$this->session->sess_destroy();
		redirect('user/index', 'refresh');
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
		redirect('user/index','refresh');
	}
	
	function block_user(){
		$block_user = array ('user_wishing_to_block' => $this->input->post('user'),
							 'user_to_block' => $this->input->post('blocked')
							 );
		$this->database_model->block_user($user_to_block);
		redirect('user/index', 'refresh');
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
		redirect('user/index','refresh');
	}
	
	public function user_inbox(){
		$data['current_view'] = 'user_inbox';
		$data['messages'] = $this->database_model->get_messages();
		$this->load->view('template', $data);
	}
	
}
