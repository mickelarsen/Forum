<?php

echo heading($category[0]['name'], 2);

echo br(1);

if($this->session->userdata('username')){
	echo anchor('posts/new_topic/'.$category[0]['id'], 'New topic');
}
echo br(2);

foreach($topics as $topic){
	
	if($topic['locked'] == 1){
		echo 'LOCKED ';
	}
	if($topic['sticky'] == 1){
		echo 'STICKY ';
	}
	
	echo anchor('posts/topic/'.$topic['id'], $topic['title']);
	echo br(1);
	echo anchor('user/user_profile/'.$topic['author'], $topic['author']);
	echo nbs(3);
	echo $topic['creation_date'];
	echo br(3);
}

echo $this->pagination->create_links();