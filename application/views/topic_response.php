<?php

if($this->session->userdata('username')){
echo form_open('posts/topic_response');
echo form_hidden('topic_id',$this->uri->segment(3));
echo form_textarea('topic_response','', 50, 80);
echo form_submit('submit', 'Post response');
echo form_close();
}else{
	echo 'Only registered users may respond to topics.';
	echo br(1);
	echo anchor('user/register', 'Register');
}