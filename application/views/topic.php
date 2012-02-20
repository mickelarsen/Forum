<?php

echo heading($topic[0]['title']);

if($this->session->userdata('admin') == 1){
	echo anchor('posts/sticky/'.$topic[0]['id'], 'Sticky this topic');
	echo nbs(1);
	echo anchor('posts/lock_topic/'.$topic[0]['id'], 'Lock this topic');
	echo br(3);
}

echo anchor('user/user_profile/'.$topic[0]['author'],$topic[0]['author']);
echo nbs(1);
if($this->session->userdata('admin') == 1){
	echo anchor('user/ban_user/'.$topic[0]['author'],'Ban this user');
}
echo br(1);
echo $topic[0]['op'];
echo br(1);
if($this->session->userdata('admin') == 1 || $topic[0]['author'] == $this->session->userdata('username')){
		echo anchor('posts/edit_response/'.$topic[0]['id'], 'Edit');
	}
echo br(2);
foreach($topic_responses as $topic_response){
	
	echo anchor('user/user_profile/'.$topic_response['user'], $topic_response['user']);
	echo nbs(1);
	if($this->session->userdata('admin') == 1){
		echo anchor('user/ban_user/'.$topic_response['user'],'Ban this user');
	}
	echo br(1);
	echo $topic_response['response'];
	echo br(1);
	if($this->session->userdata('admin') == 1 || $topic_response['user'] == $this->session->userdata('username') ){
		echo anchor('posts/edit_response/'.$topic_response['id'], 'Edit');
	}
	echo br(2);
	
}
if($this->session->userdata('username')){
	if($topic[0]['locked'] == 1){
		echo 'Cannot respond to a locked topic.';
	}else{
		echo anchor('posts/new_response/'.$topic[0]['id'], 'New response');
	}
}

