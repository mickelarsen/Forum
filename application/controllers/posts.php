<?php

class Posts extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('database_model');
	}
	
	public function index(){
		$this->load->library('breadcrumbs');
		$data['subforums'] = $this->database_model->get_forum();
		$data['categories'] = $this->database_model->get_categories();
		$data['current_view'] = 'board_view';
		$this->load->view('template', $data);
	}
	
	public function subforum(){
		$data['current_view'] = 'subforum';
		$data['subforum'] = $this->database_model->get_subforum();
		$data['categories'] = $this->database_model->get_categories_by_subforum();
		$this->load->view('template', $data);
	}

	public function category(){
		$data['current_view'] = 'category';
		$data['category'] = $this->database_model->get_category();
		$data['topics'] = $this->database_model->get_topics();
		$this->load->view('template', $data);
	}
	
	public function new_topic(){
		$data['current_view'] = 'new_topic';
		$this->load->view('template', $data);
	}
	
	function create_topic(){
		$new_topic = array('author' => $this->session->userdata('username'),
						   'title' => $this->input->post('title'),
						   'op' => $this->input->post('op'),
						   'category_id' => $this->input->post('category_id')
						   );
		$this->database_model->create_topic($new_topic);
		redirect('posts/category/'.$new_topic['category_id'], 'refresh');
	}
	
	public function topic(){
		$data['topic'] = $this->database_model->get_topic();
		$data['topic_responses'] = $this->database_model->get_topic_responses();
		$data['current_view'] = 'topic';
		$this->load->view('template', $data);
	}
	
	public function new_response(){
		$data['current_view'] = 'topic_response';
		$this->load->view('template', $data);
	}
	
	function topic_response(){
		$topic_response = array ('user' => $this->session->userdata('username'),
								 'response' => $this->input->post('topic_response'),
								 'topic_id' => $this->input->post('topic_id')
								 );
		$this->database_model->new_topic_response($topic_response);
		redirect('posts/topic/'.$topic_response['topic_id'], 'refresh');
	}
}