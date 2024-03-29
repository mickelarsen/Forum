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
	
	private function paginate($rows, $per_page, $base_url){
		$config['base_url'] = $base_url;
		$config['total_rows'] = $rows;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
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
		$per_page = 5;
		$data['topics'] = $this->database_model->get_topics($per_page, $this->uri->segment(4));
		$rows = count($data['topics']);
		//$this->paginate($rows, $per_page, base_url().'/posts/category/'.$this->uri->segment(3).'/');
		$config['base_url'] = base_url().'/posts/category/'.$this->uri->segment(3);
		$config['total_rows'] = $rows;
		$config['per_page'] = $per_page;
		$config['num_links'] = 20;
		//$this->pagination->initialize($config);
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
		$top_limit = 15;
		if($this->uri->segment(4)){
			$bot_limit = $this->uri->segment(4);
		}else{
			$bot_limit = 0;
		}
		$data['topic_responses'] = $this->database_model->get_topic_responses($top_limit, $bot_limit);
		$rows = count($data['topic_responses']);
		$per_page = 20;
		//$this->paginate($rows, $per_page);
 		$data['current_view'] = 'topic';
		$this->load->view('template', $data);
	}
	
	function lock_topic(){
		$topic_to_be_locked = $this->uri->segment(3);
		$this->database_model->lock_topic($topic_to_be_locked);
		redirect('posts/topic/'.$topic_to_be_locked, 'refresh');
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
	
	function edit_response(){
		$response_to_edit = $this->uri->segment(3);
		$data['response'] = $this->database_model->get_topic_response($response_to_edit);
		$data['current_view'] = 'edit_response';
		$this->load->view('template', 'refresh');
	}
	
	function update_response(){
		$updated_response = array('id' => $this->input->post('id'),
								  'response' => $this->input->post('response')
								  );
		$this->database_model->update_response($updated_response);
		redirect('posts/', 'refresh');
	}
	
	function sticky(){
		$sticky_topic = $this->uri->segment(3);
		$this->database_model->sticky_topic($sticky_topic);
		redirect('posts/topic/'.$sticky_topic, 'refresh');
	}
}